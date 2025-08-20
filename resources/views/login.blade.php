<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-gray-100 to-indigo-100 min-h-screen flex items-center justify-center font-sans">
    <form method="POST" action="{{ route('login') }}" class="bg-white p-8 rounded-xl shadow-md w-full max-w-sm">
        @csrf
        <h2 class="text-2xl font-bold text-center text-indigo-700 mb-6">Login</h2>

        @if (session('error'))
            <div class="text-sm text-red-600 bg-red-100 border border-red-300 px-4 py-2 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="text-sm text-green-700 bg-green-100 border border-green-300 px-4 py-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <input name="email" type="email" placeholder="Email" required
            class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300" />

        <input name="password" type="password" placeholder="Password" required
            class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-indigo-300" />

        <select name="usertype" required
            class="w-full px-4 py-2 border rounded-md mb-4 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <option value="">Select Role</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select>

        <button type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-md hover:bg-indigo-700 transition duration-200">
            Login
        </button>

        <p class="text-center text-sm mt-4 text-gray-700">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
        </p>
    </form>
</body>
</html>
