<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste Treasures</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
        /* Keyframes for pulse scaling */
        @keyframes pulseScale {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
        }
        .animate-pulseScale {
            animation: pulseScale 3s infinite;
        }
    </style>
    
</head>
<body class="bg-gray-100">
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="space-y-4 text-center">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-white"></div>
            <p class="text-white text-lg font-semibold">Loading...</p>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-700 to-blue-600 p-4 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <a href="/" class="bg-cover bg-center w-12 h-12" style="background-image: url('/images/KMC_logo.png');" aria-label="Logo"></a>
            <a href="/" class="text-white text-lg font-bold">Taste Treasures</a>
        </div>

        <!-- Hamburger Icon -->
        <div class="md:hidden">
            <button id="hamburgerButton" class="text-white focus:outline-none focus:ring-2 focus:ring-white">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Desktop Menu -->
        <ul id="desktopMenu" class="hidden md:flex space-x-4 text-white font-bold">
        <li><a href="/" class="hover:text-yellow-500">Home</a></li>
            <li><a href="/foods" class="hover:text-yellow-500">Foods</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
            
        </ul>

        <!-- User Actions -->
        <div id="userActions" class="hidden md:flex space-x-4">
            @if (Auth::check())
            <div class="relative inline-block text-left">
                <button class="inline-flex justify-center items-center text-white font-bold hover:text-yellow-500" id="dropdownButton" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.23 7.21a.75.75 0 011.06 0L10 10.92l3.71-3.71a.75.75 0 111.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 010-1.06z" />
                    </svg>
                </button>
                <div id="dropdownMenu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-50">
                    <a href="{{route('profile.show')}}" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('Profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('Log Out') }}</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition font-bold">Login</a>
            <a href="{{ route('register') }}" class="bg-white text-green-600 px-4 py-2 rounded hover:bg-gray-200 transition font-bold">Register</a>
            @endif
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden bg-green-700 text-white md:hidden">
        <ul class="space-y-2 p-4">
        <li><a href="/" class="hover:text-yellow-500">Home</a></li>
            <li><a href="/foods" class="hover:text-yellow-500">Foods</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
        </ul>
        <div class="p-4">
             @if (Auth::check())
               <form method="POST" action="{{ route('logout') }}" class="inline">
             @csrf
               <button type="submit" class="block w-full bg-yellow-500 text-white px-4 py-2 rounded font-bold text-center">Log Out</button>
               </form>
             @else
               <a href="{{ route('login') }}" class="block bg-yellow-500 text-white px-4 py-2 rounded mb-2">Login</a>
               <a href="{{ route('register') }}" class="block bg-white text-green-600 px-4 py-2 rounded">Register</a>
             @endif
        </div>
    </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-cover bg-center" style="background-image: url('{{ asset('images/kandy1.jpg') }}'); height: 400px;">
    <div class="flex flex-col items-center justify-center h-full bg-gray-800 bg-opacity-50 p-8">
            <h1 class="text-yellow-400 text-5xl text-center font-bold mb-8 animate-pulseScale">
                TASTE TREASURES 
            </h1>
            <div class="relative w-full max-w-xl">
                <input type="text" placeholder="Search..." class="w-full bg-white bg-opacity-70 text-gray-800 placeholder-gray-500 px-6 py-3 rounded-full" />
            </div>
        </div>
    </header>

    @if(Auth::check() && Auth::user()->role === 'consumer')
    <div class="container mx-auto text-center">
        <h2 class="text-5xl font-semibold mt-8">Food Orders</h2>
    </div>
    @endif
    
    <section class="bg-gradient-to-r py-12 mt-8 relative" style="background-image: url('/images/FoodBackground.jpg'); background-size: cover; background-position: center; background-blend-mode: overlay;">
  <div class="absolute inset-0 bg-black bg-opacity-70 z-0"></div>
  <div class="relative z-10 flex justify-center">
    <div class="container mx-auto text-center text-white">
        <!-- Title -->
        <h2 class="text-5xl font-extrabold mb-4">
            Get in Touch with Taste Treasures
        </h2>
        <p class="text-lg mb-8">
            Have questions or special requests? Reach out to us and let’s make your dining experience even better!
        </p>

        <!-- Features -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    <!-- Feature 1 -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="flex justify-center items-center mb-4">
            <div class="bg-red-600 text-white p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11m4 0h6m-6 0a4 4 0 10-8 0h8z" />
                </svg>
            </div>
        </div>
        <h3 class="text-2xl font-extrabold text-red-600 text-center mb-2">Fast Support</h3>
        <p class="text-gray-700 text-center">Our team is always ready to assist you with orders, feedback, and inquiries. Get in touch anytime!</p>
    </div>
    
    <!-- Feature 2 -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="flex justify-center items-center mb-4">
            <div class="bg-red-600 text-white p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <h3 class="text-2xl font-extrabold text-red-600 text-center mb-2">Quality Service</h3>
        <p class="text-gray-700 text-center">We prioritize your satisfaction with high-quality meals and quick delivery service.</p>
    </div>
    
    <!-- Feature 3 -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="flex justify-center items-center mb-4">
            <div class="bg-red-600 text-white p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.382V7.618a2 2 0 011.553-1.894L9 3m0 0l5.447 2.724A2 2 0 0115 7.618v7.764a2 2 0 01-1.553 1.894L9 20zm0 0v-6m0 0L5.553 9.276M9 14l3.447-4.724" />
                </svg>
            </div>
        </div>
        <h3 class="text-2xl font-extrabold text-red-600 text-center mb-2">Fresh Ingredients</h3>
        <p class="text-gray-700 text-center">We use only the freshest ingredients to prepare delicious and healthy meals for you.</p>
    </div>
</div>

        <!-- Call to Action -->
        <a href="{{ url('contact') }}" class="bg-yellow-500 text-red-900 font-bold text-lg px-8 py-4 rounded-full shadow-lg hover:bg-yellow-400 hover:text-red-800 transition duration-300">
            Contact Us Now
        </a>
    </div>
    </div>
</section>


    <!-- Contact Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-4">Get in Touch</h2>
            <p>If you have any questions, feel free to contact us.</p>
            <a href="mailto:info@tastetreasures.com" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded transition hover:bg-green-700">Contact Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-600 py-4">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2024 Taste Treasures. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownButton = document.getElementById("dropdownButton");
            const dropdownMenu = document.getElementById("dropdownMenu");

            dropdownButton.addEventListener("click", (event) => {
                event.stopPropagation();
                dropdownMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", () => {
                dropdownMenu.classList.add("hidden");
            });
        });
    </script>

    <!-- Loading Screen Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loader = document.getElementById('page-loader');
            if (loader) {
                const minimumTime = 2000;
                const startTime = Date.now();

                window.addEventListener('load', () => {
                    const elapsedTime = Date.now() - startTime;
                    const delay = Math.max(0, minimumTime - elapsedTime);

                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, delay);
                });
            }
        });
    </script>

    <!--Hamburger Menu-->
    <script>
            document.addEventListener("DOMContentLoaded", function () {
            const hamburgerButton = document.getElementById("hamburgerButton");
            const mobileMenu = document.getElementById("mobileMenu");

        hamburgerButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    const logoutLink = document.querySelector('#mobileMenu a[href="{{ route('logout') }}"]');

    if (logoutLink) {
        logoutLink.addEventListener("click", function (event) {
            event.preventDefault(); 

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('logout') }}";

            const csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}";

            form.appendChild(csrfToken);
            document.body.appendChild(form);
            form.submit();
        });
    }
});
</script>

</body>
</html>
