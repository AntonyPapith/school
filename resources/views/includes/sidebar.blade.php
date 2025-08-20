<!-- resources/views/layouts/sidebar.blade.php -->

  <!-- Sidebar -->
<aside class="brand-color text-white w-64 min-h-screen flex flex-col justify-between p-6">
    <div class="text-3xl font-extrabold text-blue-400 mb-4">Admin Panel</div>
    <nav class="space-y-0 text-lg">
        {{-- <a href="{{ route('admin.dashboard') }}" class="flex items-center  px-3 py-2 rounded-lg
                hover:bg-blue-500/20 transition">📚 Courses</a>
        <a href="{{ route('teacher.details') }}" class="flex items-center  px-3 py-2 rounded-lg
                hover:bg-blue-500/20 transition">🧑‍🏫 Teacher</a>
        <a href="{{ route('student.details') }}" class="flex items-center  px-3 py-2 rounded-lg
                hover:bg-blue-500/20 transition">🧑 student</a>
        <a href="{{ route('assign.teacher') }}" class="flex items-center  px-3 py-2 rounded-lg
                hover:bg-blue-500/20 transition">🎯 Assigned</a>
        <a href="{{route('offer.course')}}" class="flex items-center  px-3 py-2 rounded-lg
                hover:bg-blue-500/20 transition">🎉 Course Offer</a> --}}
        <a href="{{ route('admin.dashboard') }}"
        class="flex items-center px-3 py-2 rounded-lg transition 
                {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
            📚 Courses
        </a>

        <a href="{{ route('teacher.details') }}"
        class="flex items-center px-3 py-2 rounded-lg transition 
                {{ request()->routeIs('teacher.details') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
            🧑‍🏫 Teacher
        </a>

        <a href="{{ route('student.details') }}"
        class="flex items-center px-3 py-2 rounded-lg transition 
                {{ request()->routeIs('student.details') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
            🧑 Student
        </a>

        <a href="{{ route('assign.teacher') }}"
        class="flex items-center px-3 py-2 rounded-lg transition 
                {{ request()->routeIs('assign.teacher') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
            🎯 Assigned
        </a>

        <a href="{{ route('offer.course') }}"
        class="flex items-center px-3 py-2 rounded-lg transition 
                {{ request()->routeIs('offer.course') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
            🎉 Course Offer
        </a>
    </nav>

    <div class="mt-auto">
        <form method="" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-red-500 py-2 rounded hover:bg-red-600 font-semibold">
                Logout
            </button>
        </form>
    </div>
</aside>
