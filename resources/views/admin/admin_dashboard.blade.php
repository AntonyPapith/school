<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  @include('includes.styles')
</head>

<body class="bg-gray-50 min-h-screen flex">
  
  @include('includes.success_message')
    
  @include('includes.sidebar')
  
  <!-- Right Content Area -->
  <div class="flex-1 flex flex-col overflow-hidden">
    <!-- Main Content -->
    <main class="p-8 overflow-x-auto">
      <!-- Header -->
      <div class="mb-10 flex justify-between">
        <h2 class="text-3xl font-bold text-gray-800 underline decoration-blue-400">Course Details</h2>
        <a href="{{ route('admin.courses.add') }}" class="bg-green-500 px-5 py-2 text-white rounded hover:bg-green-600">
          <i class="fa-solid fa-plus"></i> Add Course
        </a>
      </div>
      <!-- Courses Table -->
      <div class="bg-white shadow m-6 rounded-lg overflow-auto font-sans">
        <table class="min-w-full divide-y divide-gray-200 text-[16px]">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-3 text-left text-lg font-bold text-blue-900 tracking-wide">S.No</th>
              <th class="px-4 py-3 text-left font-bold text-blue-900 tracking-wide">Image</th>
              <th class="px-4 py-3 text-left font-bold text-blue-900 tracking-wide">Course Name</th>
              <th class="px-4 py-3 text-left font-bold text-blue-900 tracking-wide">Description</th>
              <th class="px-4 py-3 text-left font-bold text-blue-900 tracking-wide">Price</th>
              <th class="px-4 py-3 text-left font-bold text-blue-900 tracking-wide">Status</th>
              <th class="px-4 py-3 text-left font-bold text-blue-900 whitespace-nowrap">Validate</th>
              <th class="px-4 py-3 text-left font-bold text-blue-900 whitespace-nowrap">Action</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200 text-gray-800">
            @foreach ($courses as $course)
              <tr class="hover:bg-gray-50 align-top">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">
                  <img src="{{ asset('images/' . $course->image) }}" alt="Course Image" class="w-20 h-16 object-cover rounded">
                </td>
                <td class="px-4 py-3 font-medium max-w-[150px] truncate">{{ $course->name }}</td>
                <!-- 📌 Limit description to 3 lines  -->
                <td class="px-4 py-3 max-w-[300px]">
                  <div class="h-[4.5rem] overflow-y-auto pr-1 text-sm leading-snug">
                    {{ $course->description }}
                  </div>
                </td>
                <td class="px-4 py-3">₹{{ $course->price }}</td>
                <td class="px-4 py-3">{{ $course->status }}</td>
                <!-- ✅ Validate -->
                <td class="px-4 py-3 whitespace-nowrap">
                  <div class="flex gap-2 flex-wrap md:flex-nowrap">
                    <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-medium whitespace-nowrap">
                        ✅ Approve
                      </button>
                    </form>
                    <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs font-medium whitespace-nowrap">
                        ❌ Reject
                      </button>
                    </form>
                  </div>
                </td>
                <!-- ✏️ Action -->
                <td class="px-4 py-3 whitespace-nowrap">
                  <div class="flex gap-2 flex-wrap md:flex-nowrap">
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs font-medium whitespace-nowrap">
                      ✏️ Edit
                    </a>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="openConfirmModal('{{ $course->id }}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-medium whitespace-nowrap">
                        🗑️ Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>

<!-- Delete Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div class="bg-white rounded shadow-lg p-6 w-96">
        <h2 class="text-xl font-semibold mb-4 text-center text-red-600">Are you sure?</h2>
        <p class="mb-6 text-center">Do you really want to delete this course?</p>
        
        <div class="flex justify-center gap-4">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Delete</button>
            </form>
            <button onclick="closeConfirmModal()" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </div>
  </div>
</div>

<script>
  function openConfirmModal(courseId) {
      const form = document.getElementById('deleteForm');
      form.action = `/admin/courses/${courseId}`; // Adjust the route if needed
      document.getElementById('confirmModal').classList.remove('hidden');
  }

  function closeConfirmModal() {
      document.getElementById('confirmModal').classList.add('hidden');
  }
</script>
