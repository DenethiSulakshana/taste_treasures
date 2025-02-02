<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foods - Taste Treasures</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

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
    
    <div id="page-loader" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="space-y-4 text-center">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-white"></div>
            <p class="text-white text-lg font-semibold">Loading...</p>
        </div>
    </div>
    
        <!-- Navbar -->
        <nav class="bg-green-600 p-4">
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
                <a href="{{url('/cart')}}" class="flex items-center text-white hover:text-yellow-500 transition duration-300 ease-in-out">
                    <i class="fas fa-shopping-cart"></i> <!-- Cart Icon -->
                    <span class="ml-2">Cart [{{$orderCount}}]</span>
                </a>
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
            <li><a href="/" class="block hover:text-yellow-500">Home</a></li>
            <li><a href="/foods" class="block hover:text-yellow-500">Foods</a></li>
            <li><a href="/about" class="hover:text-yellow-500">About Us</a></li>
            <li><a href="/contact" class="hover:text-yellow-500">Contact Us</a></li>
            <li><a href="{{url('/cart')}}" class="flex items-center text-white hover:text-yellow-500 transition duration-300 ease-in-out">
                <i class="fas fa-shopping-cart"></i> <!-- Cart Icon -->
                <span class="ml-2">Cart</span>
                </a></li>
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
    <header class="bg-cover bg-center" style="background-image: url('{{ asset('images/food.jpg') }}'); height: 400px;">
         <div class="flex flex-col items-center justify-center h-full bg-gray-800 bg-opacity-50 p-8">
         <h1 class="text-yellow-400 text-5xl font-bold mb-8 animate-pulseScale">Explore Our Delicious Menu</h1>

        
            <!-- Search bar with magnifying glass icon -->
            <div class="relative w-full max-w-xl">
                <input type="text" placeholder="Search..." class="w-full bg-white bg-opacity-70 text-gray-800 placeholder-gray-500 px-6 py-3 rounded-full outline-none focus:bg-opacity-75 transition duration-300 ease-in-out" />
            
                <!-- Magnifying glass icon inside the search bar -->
                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                </svg>
            </div>
        </div>
    </header>

    <!-- Food Section -->
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold text-center mb-8">Try with Tates Treasures</h2>

        <!-- meals Section -->
        <h3 class="text-xl font-semibold mb-4">Main Meals</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <!-- Burger Item -->
                <div class="bg-white shadow-md p-4 rounded-lg">
                <img src="/storage/foods/01JJR1XSK50RGE3SB9N7XS05XN.jpg" alt="Burger" class="w-full h-64 object-cover rounded mb-4">
                    <h4 class="text-lg font-semibold">Burger</h4>
                    <p class="text-gray-600 mb-2">A burger is a patty of ground meat, typically beef, served between two buns. Burgers can be topped with a variety of ingredients, such as cheese, lettuce, tomato, onion, and bacon. They are often served with condiments like ketchup, mustard, and mayonnaise. </p>
                    <p class="text-green-600 font-bold mb-2">Rs 750.00</p>
                    <div class="flex space-x-2">
                       
                         <!-- Add to Cart Button -->
                                <a href="http://127.0.0.1:8000/cart" class="flex-1 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                                Add to Cart
                            </a>
                                            </div>
                </div>

                <!-- Fried Rice Item -->
    <div class="bg-white shadow-md p-4 rounded-lg">
        <img src="/storage/foods/01JK2WV5Y1RX0F2WZYXSGN1T6P.jpg" alt="Fried Rice" class="w-full h-64 object-cover rounded mb-4">
        <h4 class="text-lg font-semibold">Fried Rice</h4>
        <p class="text-gray-600 mb-2">Delicious stir-fried rice cooked with fresh vegetables, egg, and a choice of chicken, seafood, or tofu, seasoned with soy sauce and aromatic spices.</p>
        <p class="text-green-600 font-bold mb-2">Rs 950.00</p>
        <div class="flex space-x-2">
            <a href="http://127.0.0.1:8000/cart" class="flex-1 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                Add to Cart
            </a>
        </div>
    </div>
                    </div>

        <!-- snacks Section -->
        <h3 class="text-xl font-semibold mb-4">Snacks</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white shadow-md p-4 rounded-lg">
                <img src="/storage/foods/01JK2VHV70HJF06SS4SPQZJYZM.jpeg" alt="French Fries" class="w-full h-64 object-cover rounded mb-4">
                <h4 class="text-lg font-semibold">French Fries</h4>
        <p class="text-gray-600 mb-2">Crispy golden fries served with ketchup or cheese dip. A perfect crunchy snack!</p>
        <p class="text-green-600 font-bold mb-2">Rs 450.00</p>
                    <div class="flex space-x-2">
                       
                          <!-- Add to Cart Button -->
                          <a href="http://127.0.0.1:8000/cart" class="flex-1 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                                Add to Cart
                            </a>
                    </div>
                </div>
            
        </div>

        <!-- Beverage Section -->

        <h3 class="text-xl font-semibold mb-4">Beverages</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            
                <div class="bg-white shadow-md p-4 rounded-lg">
                <img src="/storage/foods/01JK2VQW9BDBZMRSBQ429P6EA5.jpg" alt="Iced Coffee" class="w-full h-64 object-cover rounded mb-4">
        <h4 class="text-lg font-semibold">Iced Coffee</h4>
        <p class="text-gray-600 mb-2">Refreshing chilled coffee with a rich, creamy taste and a shot of espresso.</p>
        <p class="text-green-600 font-bold mb-2">Rs 550.00</p>
        <div class="flex space-x-2">
            <a href="http://127.0.0.1:8000/cart" class="flex-1 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                Add to Cart
                            </a>
                    </div>
         
        </div>
                </div>

        <!-- Desserts Section -->
        <h3 class="text-xl font-semibold mb-4">Desserts</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            
                <div class="bg-white shadow-md p-4 rounded-lg">
                <img src="/storage/foods/01JK2VTPJJJT5MZ62MAVXZPCW2.jpg" alt="Chocolate Cake" class="w-full h-64 object-cover rounded mb-4">
        <h4 class="text-lg font-semibold">Chocolate Cake</h4>
        <p class="text-gray-600 mb-2">A rich, moist chocolate cake topped with silky chocolate ganache.</p>
        <p class="text-green-600 font-bold mb-2">Rs 850.00</p>
                    <div class="flex space-x-2">
                        
                         <!-- Add to Cart Button -->
                         
                         <a href="http://127.0.0.1:8000/cart" class="flex-1 bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                Add to Cart
            </a>
                    
                    </div>
                </div>
         
        </div>
    </div>

    <footer class="bg-green-600 py-4">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2024 Taste Treasures. All rights reserved.</p>
        </div>
    </footer>

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
            event.preventDefault(); // Prevent the default link behavior

            // Create a form and submit it programmatically
            const form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('logout') }}";

            // Add CSRF token input
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