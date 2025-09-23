<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Courses</title>
</head>
<body class="bg-gray-900 text-white">

    <!-- Header -->
    <header class="fixed w-full bg-gradient-to-r from-indigo-900/90 via-purple-900/80 to-indigo-900/90 backdrop-blur-md shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400">
                Course Zones
            </h1>
            <nav class="space-x-5 text-lg font-semibold">
                <a href="{{ url('/') }}#hero" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">Home</a>
                <a href="{{ url('/') }}#courses" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">Courses</a>
                <a href="{{ url('/') }}#about" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">About</a>
                <a href="{{ url('/') }}#testimonials" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">Review</a>
                <a href="{{ url('/') }}#contact" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Courses Section -->
<section class="py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Heading -->
        <h2 class="text-4xl md:text-5xl font-extrabold text-center mb-14 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 relative">
            All Courses
            <div class="mt-2 flex justify-center">
                <span class="w-40 h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 rounded-full"></span>
            </div>
        </h2>

        <!-- Course Grid -->
        <div class="grid md:grid-cols-3 gap-10">
            @foreach ($courses as $course)
            <article class="relative flex flex-col bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 shadow-lg hover:scale-105 hover:shadow-cyan-500/30 transition-transform duration-500">

                <!-- Image -->
                <div class="rounded-xl overflow-hidden mb-4 h-44 shadow-lg shadow-black/25">
                    <img src="{{ asset('images/' . $course->image) }}" 
                         alt="{{ $course->name }}" 
                         class="w-full h-full object-cover rounded-lg transform hover:scale-110 transition duration-500">
                </div>

                <!-- Title -->
                <h4 class="text-xl md:text-2xl font-semibold mb-2 text-white truncate drop-shadow-md">{{ $course->name }}</h4> 

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-gray-300 text-sm mb-4">
                    <span>{{ $course->lessons ?? '24' }} lessons</span>
                    <span>{{ $course->projects ?? '6' }} projects</span>
                    <span class="ml-auto font-bold text-cyan-400">₹{{ $course->price }}</span>
                </div>

                <!-- Description -->
                <p class="text-gray-400 text-sm mb-4 line-clamp-5">
                    {{ $course->description ?? 'Learn at your own pace. Explore all lessons and projects carefully to master the course.' }}
                </p>

                <!-- Buttons aligned to bottom right -->
                <div class="mt-auto flex justify-end gap-3">
                    <a href="/course/register" 
                       class="px-4 py-2 bg-gradient-to-r from-pink-400 via-purple-500 to-blue-500 rounded-full text-white font-semibold text-sm shadow-md hover:shadow-pink-400/50 transition-transform duration-300 hover:scale-105">
                        Enroll
                    </a>
                    <a href="/course/{{ $course->id }}" 
                    class="px-4 py-2 bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500 
                            hover:from-teal-400 hover:via-cyan-400 hover:to-blue-400
                            rounded-full text-white font-semibold text-sm shadow-md 
                            hover:shadow-cyan-400/50 transition-all duration-300 transform hover:scale-105">
                        Learn More
                    </a>
                </div>

            </article>
            @endforeach
        </div>
    </div>
</section>


</body>
</html>
