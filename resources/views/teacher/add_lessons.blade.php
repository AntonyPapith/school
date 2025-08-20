<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Lesson</title>
    @include('includes.styles')
</head>
<body class="bg-gray-100 min-h-screen flex">
    @include('includes.success_message')
    <!-- Sidebar -->
    @include('includes.teachers_sidebar')

    <!-- Right Content -->
    <div class="flex-1 flex flex-col items-center justify-center p-8">
        <!-- Success Message -->
        @include('includes.success_message')
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-3xl font-bold mb-6 text-blue-800 underline text-center">Add Lesson</h2>
            <!-- Lesson Form -->
            <form action="{{ route('store.lessons') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-medium">Course Name</label>
                    <select name="course" class="w-full border p-2 rounded" required>
                        <option value="">-- Select Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->name }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium">Short Description</label>
                    <textarea name="short_description" class="w-full border p-2 rounded" required></textarea>
                </div>
                <div>
                    <label class="block font-medium">Today's Topic</label>
                    <input type="text" name="today_topic" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Upload PDF</label>
                    <input type="file" name="pdf_file" accept="application/pdf" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block font-medium">Upload Images (4 to 5)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full border p-2 rounded">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition transform hover:scale-105">Send</button>
                    <a href="{{ route('teacher.dashboard') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded transition transform hover:scale-105">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
