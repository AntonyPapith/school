<!-- resources/views/admin/add_course.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Course</title>

  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-lg bg-white p-8 rounded-2xl shadow-xl">
    <h2 class="text-3xl font-bold text-blue-700 mb-6 border-b-2 border-blue-200 pb-2">Add New Course</h2>

    <form action="{{ route('admin.courses.save') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <!-- Course Name -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">Course Name</label>
        <input type="text" name="name" placeholder="e.g. Laravel Mastery"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>
      <!-- Description -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">Course Description</label>
        <textarea name="description" rows="4" placeholder="Brief description about the course..."
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
      </div>
      <!-- Course Price -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">Course Price</label>
        <input type="number" name="price" step="0.01" placeholder="e.g. 1499"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>
      <!-- Image -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">Course Image</label>
        <input type="file" name="image"
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-blue-100 file:text-blue-700
                      hover:file:bg-blue-200" required>
      </div>
      <!-- Buttons -->
      <div class="flex justify-end gap-4">
        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg transition">Cancel</a>
        <button type="submit"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition">Save</button>
      </div>
    </form>
  </div>
</body>
</html>
