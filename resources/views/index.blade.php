<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Zone</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    /* Marquee animation for rating-based speed */
  @keyframes marquee-rating {
    0%   { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
  }
  /* Top row - normal speed */
  .animate-rating-normal {
    animation: marquee-rating 20s linear infinite;
  }
  /* Middle row - slow */
  .animate-rating-slow {
    animation: marquee-rating 30s linear infinite;
  }
  /* Bottom row - fast */
  .animate-rating-fast {
    animation: marquee-rating 12s linear infinite;
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
<!-- <section id="hero" 
    class="h-screen flex items-center justify-center 
           bg-[url('{{ asset('images/course-bg.jpg') }}')] bg-cover bg-center relative"> -->
<section id="hero" 
    class="h-screen flex items-center justify-center bg-cover bg-center relative"
    style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/70"></div>

  <!-- Content -->
  <div class="relative z-10 text-center max-w-3xl px-4">
    <h2 class="text-4xl md:text-6xl font-extrabold mb-6 
               text-transparent bg-clip-text 
               bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 
               drop-shadow-[0_4px_20px_rgba(0,0,0,0.6)] tracking-wide">
      Learn in a New Dimension
    </h2>

    <p class="text-lg md:text-xl text-gray-200 mb-8 leading-relaxed drop-shadow-md">
      Explore the best learning experiences crafted for your growth.
    </p>

    <a href="#courses" 
        class="px-8 py-3 rounded-xl font-semibold shadow-xl text-white text-lg
               bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-500
               transition-all duration-500 ease-in-out
               hover:from-purple-500 hover:via-pink-500 hover:to-cyan-500
               hover:scale-110 hover:shadow-2xl">
      🚀 Browse Courses
    </a>
  </div>
</section>
  
  <!-- Course  -->
<section id="courses" class="relative py-20 bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#0f172a] overflow-hidden">
  <div class="relative max-w-7xl mx-auto px-6">
    <!-- Heading + View All -->
    <div class="flex justify-between items-center mb-14">
      <h3 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 drop-shadow-lg relative inline-block">
        Our Premium Courses
        <!-- underline -->
        <span class="absolute left-0 -bottom-2 w-full h-1 bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 rounded-full"></span>
      </h3>

      <!-- View All button -->
      <a href="{{ route('courses.index') }}" 
        class="px-5 py-2 bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
        View All
      </a>
    </div>
    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
      @foreach ($courses->take(4) as $course)
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

  <!-- About -->
<section id="about" class="py-24 bg-gray-900 relative overflow-hidden">
  <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
    <!-- Simple Underlined Heading -->
    <h3 class="text-4xl font-extrabold mb-8 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 inline-block border-b-4 border-blue-400 pb-2">
      About Us
    </h3>

    <!-- Description -->
    <p class="text-gray-300 max-w-3xl mx-auto mb-12 text-lg leading-relaxed">
      We are a leading online learning platform offering immersive 3D learning environments that enhance understanding and retention. Our expert instructors and cutting-edge technology provide a truly interactive education experience. Join thousands of learners who are transforming the way they learn and grow.
    </p>

    <!-- Interactive Cards -->
    <div class="flex flex-col md:flex-row justify-center gap-6">
      <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-6 rounded-xl shadow-lg transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl cursor-pointer">
        <h4 class="text-xl font-semibold text-white mb-2">Expert Instructors</h4>
        <p class="text-gray-100">Learn from industry professionals with years of experience in their fields.</p>
      </div>
      <div class="bg-gradient-to-br from-green-400 to-teal-500 p-6 rounded-xl shadow-lg transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl cursor-pointer">
        <h4 class="text-xl font-semibold text-white mb-2">Interactive 3D Learning</h4>
        <p class="text-gray-100">Engage with immersive 3D environments that make learning fun and effective.</p>
      </div>
      <div class="bg-gradient-to-br from-yellow-400 to-orange-500 p-6 rounded-xl shadow-lg transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl cursor-pointer">
        <h4 class="text-xl font-semibold text-white mb-2">Flexible & Accessible</h4>
        <p class="text-gray-100">Learn at your own pace, anytime, anywhere, from any device.</p>
      </div>
    </div>
  </div>

  <!-- Background decorative shapes -->
  <div class="absolute -top-20 -left-20 w-96 h-96 bg-blue-700 opacity-20 rounded-full filter blur-3xl animate-pulse"></div>
  <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-pink-700 opacity-20 rounded-full filter blur-3xl animate-pulse"></div>
</section>


  <!-- Testimonials -->
<section id="testimonials" class="py-20 bg-gradient-to-b from-gray-950 to-gray-900 overflow-hidden relative">
  <div class="max-w-7xl mx-auto px-6">
    <h3 class="text-3xl font-bold text-center mb-12 text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-blue-400 border-b-4 border-pink-400 inline-block pb-2">
      What Our Students Say
    </h3>
    <!-- Testimonial Rows -->
    <div class="space-y-8">
      <!-- Top Row -->
      <div class="overflow-hidden relative">
        <div class="flex animate-rating-normal whitespace-nowrap gap-6"> 
          <!-- Card -->
          <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-4 rounded-lg shadow-md min-w-[250px] flex flex-col items-center gap-3 transform transition-transform duration-300 hover:scale-105 cursor-pointer">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah M." class="w-12 h-12 rounded-full border-2 border-white">
            <p class="text-gray-100 text-center text-sm">"The 3D visuals made learning so much fun!"</p>
            <div class="flex gap-1 text-sm">
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
            </div>
            <span class="font-semibold text-white text-sm">— Sarah M.</span>
          </div>

          <div class="bg-gradient-to-br from-pink-500 to-red-500 p-4 rounded-lg shadow-md min-w-[250px] flex flex-col items-center gap-3 transform transition-transform duration-300 hover:scale-105 cursor-pointer">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="James K." class="w-12 h-12 rounded-full border-2 border-white">
            <p class="text-gray-100 text-center text-sm">"Highly recommend! The quality of content is unmatched."</p>
            <div class="flex gap-1 text-sm">
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">☆</span>
            </div>
            <span class="font-semibold text-white text-sm">— James K.</span>
          </div>
        </div>
      </div>
      <!-- Middle Row -->
      <div class="overflow-hidden relative">
        <div class="flex animate-rating-slow whitespace-nowrap gap-6">
          <div class="bg-gradient-to-br from-green-400 to-teal-500 p-4 rounded-lg shadow-md min-w-[250px] flex flex-col items-center gap-3 transform transition-transform duration-300 hover:scale-105 cursor-pointer">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Lisa T." class="w-12 h-12 rounded-full border-2 border-white">
            <p class="text-gray-100 text-center text-sm">"I loved the immersive learning experience."</p>
            <div class="flex gap-1 text-sm">
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
            </div>
            <span class="font-semibold text-white text-sm">— Lisa T.</span>
          </div>

          <div class="bg-gradient-to-br from-yellow-400 to-orange-500 p-4 rounded-lg shadow-md min-w-[250px] flex flex-col items-center gap-3 transform transition-transform duration-300 hover:scale-105 cursor-pointer">
            <img src="https://randomuser.me/api/portraits/men/40.jpg" alt="Mark D." class="w-12 h-12 rounded-full border-2 border-white">
            <p class="text-gray-100 text-center text-sm">"Content quality is unmatched."</p>
            <div class="flex gap-1 text-sm">
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">☆</span>
            </div>
            <span class="font-semibold text-white text-sm">— Mark D.</span>
          </div>
        </div>
      </div>
      <!-- Bottom Row -->
      <div class="overflow-hidden relative">
        <div class="flex animate-rating-fast whitespace-nowrap gap-6">
          <div class="bg-gradient-to-br from-purple-400 to-pink-500 p-4 rounded-lg shadow-md min-w-[250px] flex flex-col items-center gap-3 transform transition-transform duration-300 hover:scale-105 cursor-pointer">
            <img src="https://randomuser.me/api/portraits/men/50.jpg" alt="Alex P." class="w-12 h-12 rounded-full border-2 border-white">
            <p class="text-gray-100 text-center text-sm">"Best online learning platform ever!"</p>
            <div class="flex gap-1 text-sm">
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
            </div>
            <span class="font-semibold text-white text-sm">— Alex P.</span>
          </div>

          <div class="bg-gradient-to-br from-indigo-400 to-blue-500 p-4 rounded-lg shadow-md min-w-[250px] flex flex-col items-center gap-3 transform transition-transform duration-300 hover:scale-105 cursor-pointer">
            <img src="https://randomuser.me/api/portraits/women/25.jpg" alt="Mia L." class="w-12 h-12 rounded-full border-2 border-white">
            <p class="text-gray-100 text-center text-sm">"Highly immersive and engaging."</p>
            <div class="flex gap-1 text-sm">
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
              <span class="text-yellow-400">★</span>
            </div>
            <span class="font-semibold text-white text-sm">— Mia L.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Contact -->
<section id="contact" class="relative py-20 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <!-- Heading -->
    <h3 class="text-4xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 border-b-4 border-purple-500 inline-block pb-2">
      Get in Touch
    </h3>
    <p class="text-gray-300 mb-12 max-w-2xl mx-auto">
      Have questions or need more information? Reach out to us anytime. We’d love to hear from you!
    </p>
    <!-- Contact Info + Form -->
    <div class="grid md:grid-cols-2 gap-12 text-left">
      <!-- Contact Details -->
      <div class="space-y-6">
        <div class="flex items-center gap-4 bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
          <span class="text-pink-400 text-2xl">📧</span>
          <p class="text-gray-300"><strong>Email:</strong> info@3dcoursehub.com</p>
        </div>
        <div class="flex items-center gap-4 bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
          <span class="text-blue-400 text-2xl">📞</span>
          <p class="text-gray-300"><strong>Phone:</strong> +1 (234) 567-890</p>
        </div>
        <div class="flex items-center gap-4 bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
          <span class="text-green-400 text-2xl">📍</span>
          <p class="text-gray-300"><strong>Location:</strong> New York, USA</p>
        </div>
        <!-- Social Links -->
        <div class="flex gap-4 mt-4 justify-center">
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-500 text-white text-lg shadow-md hover:bg-blue-600 transition transform hover:scale-110">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-500 text-white text-lg shadow-md hover:bg-pink-600 transition transform hover:scale-110">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-700 text-white text-lg shadow-md hover:bg-blue-800 transition transform hover:scale-110">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <!-- Contact Form -->
      <form class="bg-gray-800 p-6 rounded-xl shadow-lg space-y-4">
        <input type="text" placeholder="Your Name" class="w-full px-4 py-3 rounded-lg bg-gray-900 text-gray-200 focus:ring-2 focus:ring-pink-500 outline-none">
        <input type="email" placeholder="Your Email" class="w-full px-4 py-3 rounded-lg bg-gray-900 text-gray-200 focus:ring-2 focus:ring-pink-500 outline-none">
        <textarea placeholder="Your Message" rows="4" class="w-full px-4 py-3 rounded-lg bg-gray-900 text-gray-200 focus:ring-2 focus:ring-pink-500 outline-none"></textarea>
        <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 px-6 py-3 rounded-lg font-semibold text-white shadow-lg hover:scale-105 transition-transform duration-300">
          Send Message
        </button>
      </form>
    </div>
  </div>
</section>

  <!-- Footer -->
<footer class="bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-900 py-10 text-gray-300">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8 text-center md:text-left">
    
    <!-- Brand -->
    <div>
      <h4 class="text-xl font-bold text-white mb-4">3D Course Hub</h4>
      <p class="text-sm text-gray-400">
        Immersive learning with 3D experiences that make education engaging and unforgettable.
      </p>
    </div>
    
    <!-- Quick Links -->
    <div>
      <h4 class="text-lg font-semibold text-white mb-4">Quick Links</h4>
      <ul class="space-y-2">
        <li><a href="#about" class="hover:text-pink-400 transition">About Us</a></li>
        <li><a href="#courses" class="hover:text-pink-400 transition">Courses</a></li>
        <li><a href="#testimonials" class="hover:text-pink-400 transition">Testimonials</a></li>
        <li><a href="#contact" class="hover:text-pink-400 transition">Contact</a></li>
      </ul>
    </div>
    
    <!-- Social Media -->
    <div>
      <h4 class="text-lg font-semibold text-white mb-4">Follow Us</h4>
      <div class="flex justify-center md:justify-start gap-5 text-2xl">
        <a href="#" class="hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
        <a href="#" class="hover:text-pink-500 transition"><i class="fab fa-instagram"></i></a>
        <a href="#" class="hover:text-blue-600 transition"><i class="fab fa-linkedin"></i></a>
        <a href="#" class="hover:text-red-500 transition"><i class="fab fa-youtube"></i></a>
        <a href="#" class="hover:text-blue-500 transition"><i class="fab fa-facebook"></i></a>
      </div>
    </div>
  </div>

  <!-- Bottom -->
  <div class="text-center text-gray-400 text-sm mt-8 border-t border-gray-700 pt-4">
    &copy; 2025 <span class="text-white font-semibold">3D Course Hub</span>. All rights reserved.
  </div>
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
