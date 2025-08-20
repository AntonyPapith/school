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

  <!-- Main Content Area -->
  <div class="flex-1 flex flex-col">
    <main class="p-8 overflow-x-auto relative">
      <div class="mb-10 flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-800 underline decoration-blue-400">Assign Course For Teacher</h2>
      </div>

      <!-- Form -->
      <form action="{{ route('assign.course') }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        <!-- Teacher Dropdown -->
        <div>
          <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-1">Select Teacher</label>
          <select id="teacher_id" name="teacher_id" class="w-full border rounded px-4 py-2 focus:ring focus:outline-none" required>
            <option value="">-- Choose Teacher --</option>
            @foreach ($teachers as $teacher)
              @if ($teacher->status === 'approved')
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
              @endif
            @endforeach
          </select>
          @error('teacher_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Course Dropdown -->
        <div>
          <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Select Course</label>
          <select id="course_id" name="course_id" class="w-full border rounded px-4 py-2 focus:ring focus:outline-none" required>
            <option value="">-- Choose Course --</option>
            @foreach ($courses as $course)
              @if ($course->status === 'approved')
                <option value="{{ $course->id }}">{{ $course->name }}</option>
              @endif
            @endforeach
          </select>
          @error('course_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <!-- Submit Buttons -->
        <div class="text-right space-x-3">
          <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded shadow hover:bg-blue-700 transition">
            <i class="fas fa-plus-circle mr-2"></i> Add
          </button>
          <a href="{{ route('assign.teacher') }}" class="bg-gray-300 text-gray-800 px-5 py-2 rounded shadow hover:bg-gray-400 transition">
            <i class="fas fa-times-circle mr-2"></i> Cancel
          </a>
        </div>
      </form>
    </main>
  </div>
</body>
</html>
