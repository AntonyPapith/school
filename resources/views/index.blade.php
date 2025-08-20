<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Zone</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    html{
        scroll-behavior: smooth;
    }
    body {
      font-family: 'Poppins', sans-serif;
    }
    /* Marquee animation */
    @keyframes marquee {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
    .animate-marquee {
      animation: marquee 20s linear infinite;
    }
    .animate-marquee-pause {
      animation-play-state: paused;
    }
    /* 3D card effect */
    .card-3d {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-3d:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body class="bg-gray-950 text-white">
  @include('includes.notifications')

  <!-- Header -->
  <header class="fixed w-full bg-gradient-to-r from-indigo-900/90 via-purple-900/80 to-indigo-900/90 backdrop-blur-md shadow-lg z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl md:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400">
        Course Zones
      </h1>
      <nav class="space-x-5 text-lg font-semibold">
        <a href="#hero" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">Home</a>
        <a href="#courses" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">Courses</a>
        <a href="#about" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">About</a>
        <a href="#testimonials" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">review</a>
        <a href="#contact" class="relative hover:text-pink-400 transition duration-300 after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-0.5 after:bg-gradient-to-r after:from-pink-400 after:to-purple-400 hover:after:w-full after:transition-all after:duration-300">Contact</a>
      </nav>
    </div>
  </header>
  <!-- Offer Banner -->
  @if($offers->count() > 0)
    @foreach($offers as $offer)
        <div id="offer-banner" class="fixed top-16 left-0 w-full z-40 bg-gradient-to-r from-green-500 via-teal-400 to-blue-500 text-white font-semibold py-2 overflow-hidden shadow-lg cursor-pointer">
            <div id="marquee" class="whitespace-nowrap animate-marquee">
                🚀 {{ $offer->course_name }} now only ₹{{ $offer->course_price }} — Offer ends at {{ \Carbon\Carbon::parse($offer->expiry_time)->setTimezone('Asia/Kolkata')->format('h:i A') }}! Click here to register →
            </div>
        </div>
    @endforeach
  @endif
  <!-- Hero -->
  <section id="hero" class="h-screen flex items-center justify-center bg-[url('{{ asset('images/course-bg.jpg') }}')] bg-cover bg-center relative">
    <div class="absolute inset-0 bg-black/45"></div>
    <div class="relative z-10 text-center max-w-3xl px-4">
      <h2 class="text-4xl md:text-6xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 drop-shadow-lg">
        Learn in a New Dimension
      </h2>
      <p class="text-lg md:text-xl text-gray-200 mb-6">Explore Best learning experiences crafted for your growth.</p>
      {{-- <a href="#courses" class="bg-gradient-to-r from-pink-500 to-purple-600 px-6 py-3 rounded-lg font-semibold text-white shadow-lg hover:scale-105 transition-transform duration-300">Browse Courses</a> --}}
      <a href="#courses" 
          class="px-6 py-3 rounded-lg font-semibold shadow-lg text-white
                bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-500
                transition-all duration-500 ease-in-out
                hover:from-purple-500 hover:via-pink-500 hover:to-cyan-500
                hover:text-white hover:scale-105">
        Browse Courses
      </a>
    </div>
  </section>
  
  {{-- Course --}}
  <section id="courses" class="relative py-20 bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#0f172a] overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-6">
      <!-- Heading -->
      <h3 class="text-4xl font-extrabold text-center mb-14 text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 drop-shadow-lg">
        Our Premium Courses
      </h3>
      <!-- Cards -->
      <div class="grid md:grid-cols-3 gap-10">
        @foreach ($courses as $course)
          <article class="relative bg-white/5 backdrop-blur-lg border border-white/10 rounded-2xl p-6 shadow-2xl hover:scale-[1.05] hover:shadow-cyan-500/30 transition-transform duration-500">
            <div class="rounded-xl overflow-hidden mb-4 h-44 shadow-lg shadow-black/20">
              <img src="{{ asset('images/' . $course->image) }}" 
                   alt="{{ $course->name }}" 
                   class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
            </div>
            <!-- Title -->
            <h4 class="text-xl font-semibold mb-3 text-white truncate drop-shadow-md">{{ $course->name }}</h4> 
  
            <!-- Meta Info -->
            <div class="flex items-center gap-4 text-gray-300 text-sm mb-4">
              <span>{{ $course->lessons ?? '24' }} lessons</span>
              <span>{{ $course->projects ?? '6' }} projects</span>
              <span class="ml-auto font-bold text-cyan-300">Price ₹{{ $course->price }}</span>
            </div>
            <!-- Footer -->
            <div class="flex justify-between items-center mt-4">
              <span class="text-gray-400 text-sm">
                {{ $course->description ?? 'Learn at your own pace' }}
              </span>
              <a href="/register" 
                 class="px-4 py-2 bg-gradient-to-r from-pink-400 via-purple-500 to-blue-500 rounded-full text-white font-semibold text-sm shadow-lg hover:shadow-pink-400/40 transition">
                Enroll
              </a>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  
  <!-- About -->
  <section id="about" class="py-20 bg-gray-900">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">About Us</h3>
      <p class="text-gray-300 max-w-3xl mx-auto">We are a leading online learning platform offering immersive 3D learning environments that enhance understanding and retention. Our expert instructors and cutting-edge technology provide a truly interactive education experience.</p>
    </div>
  </section>

  <!-- Testimonials -->
  <section id="testimonials" class="py-20 bg-gradient-to-b from-gray-950 to-gray-900">
    <div class="max-w-7xl mx-auto px-6">
      <h3 class="text-3xl font-bold text-center mb-12 text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-blue-400">What Our Students Say</h3>
      <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg">
          <p class="text-gray-300 mb-4">"The 3D visuals made learning so much fun! I felt like I was in a virtual classroom."</p>
          <span class="block font-semibold text-pink-400">— Sarah M.</span>
        </div>
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg">
          <p class="text-gray-300 mb-4">"Highly recommend! The quality of content and interaction is unmatched."</p>
          <span class="block font-semibold text-pink-400">— James K.</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-20 bg-gray-900">
    <div class="max-w-5xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Get in Touch</h3>
      <p class="text-gray-300 mb-8">Have questions or need more information? Reach out to us!</p>
      <a href="mailto:info@3dcoursehub.com" class="bg-gradient-to-r from-pink-500 to-purple-600 px-6 py-3 rounded-lg font-semibold text-white shadow-lg hover:scale-105 transition-transform duration-300">Email Us</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-900 py-6 text-center text-gray-300 text-sm">
    &copy; 2025 3D Course Hub. All rights reserved.
  </footer>


  <!-- JS for Offer Banner -->
  <script>
    window.addEventListener('load', () => {
      setTimeout(() => {
        document.getElementById('offer-banner').classList.remove('hidden');
      }, 2000);
    });
    document.addEventListener("scroll", () => {
      const hero = document.getElementById("hero");
      const offerBanner = document.getElementById("offer-banner");
      
      const heroBottom = hero.getBoundingClientRect().bottom;
      
      if (heroBottom > 0) {
        offerBanner.classList.remove("hidden");
      } else {
        offerBanner.classList.add("hidden");
      }
    });

    const marquee = document.getElementById('marquee');
    marquee.addEventListener('mouseover', () => marquee.classList.add('animate-marquee-pause'));
    marquee.addEventListener('mouseout', () => marquee.classList.remove('animate-marquee-pause'));
    marquee.addEventListener('click', () => {
      window.location.href = '/course/register'; // Change to your course register route
    });
  </script>
    
</body>
</html>
