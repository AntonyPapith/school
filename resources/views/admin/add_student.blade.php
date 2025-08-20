<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-xl bg-white p-8 rounded-xl shadow-md border border-gray-200">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Add New Student</h2>
        <form action="{{ route('student.add.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Course -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                <select name="course" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Date of Birth -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input type="date" name="dob" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <!-- Contact -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                <input type="text" name="contact" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="text" name="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Buttons -->
            <div class="flex justify-end space-x-4 pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md font-semibold transition">
                    Save
                </button>
                <a href="{{ url()->previous() }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-md font-semibold transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>
