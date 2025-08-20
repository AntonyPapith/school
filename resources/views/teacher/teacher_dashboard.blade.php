<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    @include('includes.styles')
</head>
<body class="bg-gray-100 min-h-screen flex">

    @include('includes.success_message')
    <!-- Sidebar -->
    @include('includes.teachers_sidebar')

    <!-- Right Content -->
    <div class="flex-1 flex flex-col p-8">

        <!-- Heading -->
        <h2 class="text-3xl font-bold mb-6 text-blue-800 underline">Assigned Courses</h2>

        <!-- Welcome Message -->
        @if ($teacher)
            <div class="mb-8 w-full max-w-2xl bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded shadow">
                <p class="text-lg font-medium">
                    Welcome, <span class="font-semibold">{{ $teacher->name }}</span> —
                    @if ($courses->isNotEmpty())
                        <span class="font-semibold">{{ $courses->pluck('name')->implode(', ') }}</span> is allocated to you.
                    @else
                        <span class="italic text-gray-600">no course is allocated yet.</span>
                    @endif
                </p>
            </div>
        @endif

        <!-- Course Cards -->
        @if ($courses->isEmpty()) 
            <p class="text-gray-600">No courses assigned yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <div class="bg-white p-4 shadow rounded-lg border-l-4 border-blue-500">
                        <h3 class="text-xl font-semibold text-blue-800">{{ $course->name }}</h3>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</body>
</html>
