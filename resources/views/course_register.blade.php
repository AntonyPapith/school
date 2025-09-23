<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Offer Course Register</title>
</head>
<body class="bg-gradient-to-r from-indigo-50 via-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-6 font-sans">


  <div class="w-full max-w-2xl bg-gradient-to-br from-white to-blue-50 shadow-2xl rounded-2xl p-10 border border-blue-100">
    <h2 class="text-3xl font-extrabold text-indigo-700 mb-8 text-center tracking-wide">
      Course Registration
    </h2>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 shadow-sm text-center font-medium">
      {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('course.register.save') }}" method="POST" class="space-y-6">
      @csrf

      <!-- Name -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition"
          placeholder="Your Name">
        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Email -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition"
          placeholder="you@example.com">
        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Phone -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">Phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition"
          placeholder="1234567890">
        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Preferred Mode -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">Preferred Mode</label>
        <select name="prefer_mode"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition">
          <option value="">Select Mode</option>
          <option value="online" {{ old('prefer_mode')=='online'?'selected':'' }}>Online</option>
          <!-- <option value="offline" {{ old('prefer_mode')=='offline'?'selected':'' }}>Offline</option> -->
        </select>
        @error('prefer_mode') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Course Name -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">Course</label>
        <input type="text" name="course" value="{{ old('course') }}"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition"
          placeholder="Course Name">
        @error('course') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Education -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">Education</label>
        <input type="text" name="education" value="{{ old('education') }}"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition"
          placeholder="Your Education">
        @error('education') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- City -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">City</label>
        <input type="text" name="city" value="{{ old('city') }}"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition"
          placeholder="Your City">
        @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Age -->
      <div>
        <label class="block text-indigo-800 font-semibold mb-2">Age</label>
        <input type="number" name="age" value="{{ old('age') }}"
          class="w-full border border-blue-200 rounded-lg px-4 py-2 bg-white/70 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 transition"
          placeholder="Your Age" min="1">
        @error('age') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Submit Button -->
      <div class="text-center mt-8">
        <button type="submit"
          class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold tracking-wide px-10 py-3 rounded-lg shadow-lg transition duration-200">
          Register Now
        </button>
      </div>
    </form>
  </div>

  <!-- Welcome Popup -->
  <script>
    window.addEventListener("DOMContentLoaded", () => {
      alert("👋 Welcome to the Course Registration Form!");
    });
  </script>

</body>
</html>
