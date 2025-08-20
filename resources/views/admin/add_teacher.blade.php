<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-xl bg-white p-8 rounded-xl shadow-md border border-gray-200">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Add New Teacher</h2>

        <form action="{{ route('teacher.add.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Qualification -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Qualification</label>
                <input type="text" name="qualification" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Contact -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                <input type="text" name="contact" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Id</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
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
