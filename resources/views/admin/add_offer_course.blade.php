<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Offer Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-4 text-center text-blue-600">Add Offer Course</h2>

    <form action="{{ route('offer.courses.save') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Course Name</label>
            <input type="text" name="course_name" required class="w-full border rounded-lg p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Course Description</label>
            <textarea name="course_description" required class="w-full border rounded-lg p-2"></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Course Price</label>
            <input type="number" name="course_price" required class="w-full border rounded-lg p-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Offer Duration (Hours)</label>
            <input type="number" name="offer_hours" min="1" required class="w-full border rounded-lg p-2">
        </div>

         <!-- Buttons -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('offer.course') }}"
            class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg transition">Cancel</a>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition">
                Save
            </button>
        </div>
    </form>
</div>

</body>
</html>
