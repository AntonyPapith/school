<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $courses = DB::table('courses')
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc') // latest updated first
            ->get();

        $offers = DB::table('offer_course')
            ->where('status', 'approved')
            ->where('expiry_time', '>', now())
            ->get();        

        return view('index', compact('courses', 'offers'));
    }

    public function adminDashboard() {
        $courses = DB::table('courses')->get();
        return view('admin.admin_dashboard', compact('courses'));
    }

    public function AddCourse()
    {
        return view('admin.add_course');
    }

    public function saveCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Save uploaded image to /public/images
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        // Insert data using DB query builder
        DB::table('courses')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Course added successfully!');
    }

    public function edit($id) {
        $course = DB::table('courses')->where('id', $id)->first();
        return view('admin.edit_course', compact('course'));
    }    

    public function update(Request $request, $id) {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
        ];
    
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }
    
        DB::table('courses')->where('id', $id)->update($data);
    
        return redirect()->route('admin.dashboard')->with('success', 'Course updated successfully!');
    }
    
    public function destroy($id) {
        DB::table('courses')->where('id', $id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Course deleted successfully!');
    }    

    public function approve($id)
    {
        DB::table('courses')->where('id', $id)->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Course approved successfully!');
    }

    public function reject($id)
    {
        DB::table('courses')->where('id', $id)->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Course rejected.');
    }

    public function offerCourse()
    {
        $courses = DB::table('offer_course')->get();
        return view('admin.offer_course',compact('courses'));
    }

    public function offerCourseAdd()
    {
        return view('admin.add_offer_course');
    }

    public function offerCourseSave(Request $request)
    {
        DB::table('offer_course')->insert([
            'course_name' => $request->course_name,
            'course_description' => $request->course_description,
            'course_price' => $request->course_price,
            'offer_hours' => (int)$request->offer_hours,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
            'expiry_time' => null // This needs expiry_time column
        ]);
        return redirect()->route('offer.course')->with('success', 'Offer course added successfully!');
    }

public function offerCourseEdit($id)
{
    $course = DB::table('offer_course')->where('id', $id)->first();
    return view('admin.edit_offer_course', compact('course'));
}

public function offerCourseUpdate(Request $request, $id)
{
    DB::table('offer_course')->where('id', $id)->update([
        'course_name' => $request->course_name,
        'course_description' => $request->course_description,
        'course_price' => $request->course_price,
    ]);

    return redirect()->route('offer.course')->with('success', 'Offer Course updated successfully!');
}

public function destroyOffer($id)
{
    DB::table('offer_course')->where('id', $id)->delete();
    return redirect()->route('offer.course')->with('success', 'Offer Course deleted successfully!');
}

public function approveOffer($id)
{
    $offer = DB::table('offer_course')->where('id', $id)->first();
    if ($offer) {
        DB::table('offer_course')
            ->where('id', $id)
            ->update([
                'status' => 'approved',
                'expiry_time' => now()->addHours((int) $offer->offer_hours),
                'updated_at' => now()
            ]);
        return redirect()->route('offer.course')->with('success', 'Offer course approved successfully!');
    }
    return redirect()->route('offer.course')->with('error', 'Course not found!');
}

public function rejectOffer($id)
{
    DB::table('offer_course')->where('id', $id)->update(['status' => 'rejected']);
    return redirect()->route('offer.course')->with('success', 'Offer Course rejected successfully!');
}


}
