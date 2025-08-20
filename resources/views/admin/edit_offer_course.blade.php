<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Offer Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Edit Offer Course</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('offer.courses.update', $course->course_id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Course Name -->
        <div>
            <label class="block mb-1 font-semibold">Course Name</label>
            <input type="text" name="course_name" value="{{ old('course_name', $course->course_name) }}" 
                class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>

        <!-- Course Description -->
        <div>
            <label class="block mb-1 font-semibold">Course Description</label>
            <textarea name="course_description" rows="4" 
                class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400" required>{{ old('course_description', $course->course_description) }}</textarea>
        </div>

        <!-- Course Price -->
        <div>
            <label class="block mb-1 font-semibold">Course Price</label>
            <input type="number" step="0.01" name="course_price" value="{{ old('course_price', $course->course_price) }}" 
                class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400" required>
        </div>

        <!-- Offer Hours -->
        <div>
            <label class="block mb-1 font-semibold">Offer Duration (Hours)</label>
            <input type="number" name="offer_hours" value="{{ old('offer_hours', $course->offer_hours) }}" 
                class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400" placeholder="Enter number of hours" required>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('offer.course') }}"
            class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg transition">Cancel</a>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                Update
            </button>
        </div>
    </form>
</div>

</body>
</html>
