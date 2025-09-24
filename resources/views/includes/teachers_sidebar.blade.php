
<aside class="brand-color text-white w-64 min-h-screen flex flex-col justify-between p-6">
    <div>
        <div class="text-3xl font-extrabold text-blue-400 mb-4">Teacher Panel</div>
        
        <nav class="space-y-0 text-lg">
            <a href="{{ route('teacher.dashboard') }}"
               class="flex items-center px-3 py-2 rounded-lg transition
                      {{ request()->routeIs('teacher.dashboard') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                📚 Assigned Courses
            </a>

            <a href="#"
               class="flex items-center px-3 py-2 rounded-lg transition
                      {{ request()->routeIs('teacher/profile*') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                👨‍🏫 My Profile
            </a>

            <a href="{{ route('add.lessons') }}"
               class="flex items-center px-3 py-2 rounded-lg transition
                      {{ request()->routeIs('add.lessons') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                📜 Lesson
            </a>

            <a href="{{ route('teacher.exam.name') }}"
               class="flex items-center px-3 py-2 rounded-lg transition
                      {{ request()->routeIs('teacher.exam.name') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                📝 Exam
            </a>

            <a href="{{ route('teacher.answer.sheet') }}"
               class="flex items-center px-3 py-2 rounded-lg transition
                      {{ request()->routeIs('teacher.answer.sheet') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                ✅ Answer Sheet
            </a>

            <a href="{{ route('teacher.video.calls') }}"
            class="flex items-center px-3 py-2 rounded-lg transition
                    {{ request()->routeIs('teacher.video.calls') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500/20' }}">
                🎥 Video Call
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
