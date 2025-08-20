    {{-- <!-- Sidebar -->
    <aside class="brand-color text-white w-64 min-h-screen flex flex-col justify-between p-6">
        <div>
            <div class="text-3xl font-extrabold text-blue-400 mb-4">Student Panel</div>
            <nav class="space-y-0 text-lg">
                <a href="#" class="flex items-center  px-3 py-2 rounded-lg
                  hover:bg-blue-500/20 transition">📚 Course</a>
                <a href="{{ route('student.exam.courses') }}" class="flex items-center  px-3 py-2 rounded-lg
                  hover:bg-blue-500/20 transition">📝 Exam</a>
                <a href="{{ route('student.exam.results') }}" class="flex items-center  px-3 py-2 rounded-lg
                  hover:bg-blue-500/20 transition">📑 View Exam Results </a>
            </nav>
        </div>
        <div class="mt-auto">
            <form method="" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-500 py-2 rounded hover:bg-red-600 font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </aside> --}}

<aside class="brand-color text-white w-64 min-h-screen flex flex-col justify-between p-6">
    <div>
        <div class="text-3xl font-extrabold text-blue-400 mb-4">Student Panel</div>
        <nav class="space-y-0 text-lg">
            <a href="#"
               class="flex items-center px-3 py-2 rounded-lg transition 
                      {{ request()->is('student/course*') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                📚 Course
            </a>

            <a href="{{ route('student.exam.courses') }}"
               class="flex items-center px-3 py-2 rounded-lg transition 
                      {{ request()->routeIs('student.exam.courses') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                📝 Exam
            </a>

            <a href="{{ route('student.exam.results') }}"
               class="flex items-center px-3 py-2 rounded-lg transition 
                      {{ request()->routeIs('student.exam.results') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                📑 View Exam Results
            </a>
        </nav>
    </div>

    <div class="mt-auto">
        <form method="" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-red-500 py-2 rounded hover:bg-red-600 font-semibold">
                Logout
            </button>
        </form>
    </div>
</aside>
