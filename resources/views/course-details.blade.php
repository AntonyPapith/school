<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} - Course Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

    <!-- Course Details Section -->
    <section class="pt-28 pb-20 max-w-6xl mx-auto px-6">
        <!-- Course Image -->
        <div class="rounded-xl overflow-hidden mb-8 shadow-2xl">
            <img src="{{ asset('images/' . $course->image) }}" 
                 alt="{{ $course->name }}" 
                 class="w-full h-96 object-cover object-center">
        </div>

        <!-- Course Title -->
        <h2 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 mb-6">
            {{ $course->name }}
        </h2>

        <!-- Meta Info -->
        <div class="flex flex-wrap gap-6 text-gray-300 mb-8">
            <div><span class="font-semibold text-white">Duration:</span> 6 weeks</div>
            <div><span class="font-semibold text-white">Lessons:</span> {{ $course->lessons ?? 24 }}</div>
            <div><span class="font-semibold text-white">Projects:</span> {{ $course->projects ?? 6 }}</div>
            <div><span class="font-semibold text-white">Level:</span> Beginner</div>
        </div>

        <!-- About Course -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-white mb-4">About This Course</h3>
            <p class="text-gray-300 leading-relaxed">
                {{ $course->description ?? 'This course is designed to give beginners a solid foundation in web development. Each lesson is practical and project-based, helping you gain real experience building websites from scratch.' }}
            </p>
        </div>

        <!-- Features / Details -->
        <div class="grid md:grid-cols-2 gap-6 mb-12">
            <div class="bg-white/10 rounded-xl p-6 shadow-lg">
                <h4 class="text-xl font-semibold mb-2 text-white">Course Features</h4>
                <ul class="list-disc list-inside text-gray-300">
                    <li>Hands-on projects</li>
                    <li>Quizzes to test your knowledge</li>
                    <li>Downloadable resources</li>
                    <li>Community support</li>
                    <li>Certificate on completion</li>
                </ul>
            </div>
            <div class="bg-white/10 rounded-xl p-6 shadow-lg">
                <h4 class="text-xl font-semibold mb-2 text-white">What You'll Learn</h4>
                <ul class="list-disc list-inside text-gray-300">
                    <li>HTML syntax and structure</li>
                    <li>Semantic HTML & SEO basics</li>
                    <li>Responsive design using Flexbox & Grid</li>
                    <li>Forms and validation</li>
                    <li>Basic web accessibility principles</li>
                </ul>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-white mb-4">Course Description</h3>
            <p class="text-gray-300 leading-relaxed">
                {{ $course->description ?? 'This course is perfect for anyone who wants to start a career in web development or just build their own websites. By the end of the course, you will be able to create fully structured, accessible, and responsive websites.' }}
            </p>
        </div>

        <!-- Enroll Button -->
        <div class="text-right">
            <a href="/course/register" 
               class="px-6 py-3 bg-gradient-to-r from-pink-400 via-purple-500 to-blue-500 rounded-full text-white font-semibold shadow-lg hover:shadow-pink-400/50 transition-transform duration-300 hover:scale-105">
               Enroll Now
            </a>
        </div>
    </section>

</body>
</html>
