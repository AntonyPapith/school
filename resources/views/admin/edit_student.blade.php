<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Student</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  @include('includes.success_message')

  <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
    <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Edit Student Details</h2>

    <form action="{{ route('student.details.update', $student->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $student->name) }}" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-1">Date of Birth</label>
        <input type="date" name="dob" value="{{ old('dob', $student->dob) }}" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-1">Gender</label>
        <select name="gender" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">-- Select Gender --</option>
          <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
          <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
        </select>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-1">Contact</label>
        <input type="text" name="contact" value="{{ old('contact', $student->contact) }}" required class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="flex justify-end space-x-3">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Save</button>
        <a href="{{ route('student.details') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
