<!DOCTYPE html>
<html>
<head>
    <title>CourseZon | Learn & Grow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center px-4 py-10 font-sans">
    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full text-center">
        <h2 class="text-3xl font-bold text-indigo-700 mb-4">CourseZon | Learn & Grow</h2>
        <p class="text-lg mb-2"><strong>Welcome,</strong> {{ $user->name }}</p>
        <p class="text-gray-600 mb-4">Your registration is pending approval by the admin.</p>
        <a href="{{ route('logout') }}"
           class="inline-block mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition">
            Logout
        </a>
    </div>
</body>
</html>
