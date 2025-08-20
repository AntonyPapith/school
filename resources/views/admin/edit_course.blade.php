<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

  <div class="max-w-2xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Edit Course</h2>
    
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ $course->name }}" class="w-full border p-2 rounded" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Price</label>
        <input type="number" name="price" value="{{ $course->price }}" class="w-full border p-2 rounded" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Image</label>
        <input type="file" name="image" class="w-full border p-2 rounded">
        <p class="text-sm text-gray-500 mt-1">Current: {{ $course->image }}</p>
      </div>

      <div class="flex justify-between">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
      </div>
    </form>
  </div>

</body>
</html>
