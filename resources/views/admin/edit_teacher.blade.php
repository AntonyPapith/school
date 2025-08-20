<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Teacher</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
    <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Edit Teacher Details</h2>

    @include('includes.success_message')

    <form action="{{ route('teacher.details.update', $teachers->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $teachers->name) }}" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-1">Qualification</label>
        <input type="text" name="qualification" value="{{ old('qualification', $teachers->qualification) }}" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-1">Contact</label>
        <input type="text" name="contact" value="{{ old('contact', $teachers->contact) }}" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $teachers->email) }}" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="flex justify-between">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Update</button>
        <a href="{{ route('teacher.details') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
