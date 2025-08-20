<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-200 min-h-screen flex items-center justify-center font-sans">
    <form method="POST" action="{{ route('register') }}" class="bg-white shadow-lg rounded-xl p-8 w-full max-w-sm">
        @csrf
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h2>
        {{-- Show validation errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 text-sm px-4 py-2 rounded mb-4">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {{-- Show flash message --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 text-sm px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <input name="name" placeholder="Name" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-300" />
        <input name="email" type="email" placeholder="Email" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-300" />
        <input name="password" type="password" placeholder="Password" required class="w-full px-4 py-2 border rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-blue-300" />
        
        <select name="usertype" required class="w-full px-4 py-2 border rounded-md mb-4 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
            <option value="">Select Role</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select>

        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200">
            Register
        </button>

        <p class="text-center text-sm mt-4 text-gray-700">
            Already registered?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </form>
</body>
</html>
