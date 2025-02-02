<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Taste Treasures</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-green-200 via-white to-blue-200">

    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="space-y-4 text-center">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-white"></div>
            <p class="text-white text-lg font-semibold">Loading...</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-green-600 p-4 z-10 relative">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="/" class="bg-cover bg-center w-12 h-12" style="background-image: url('/images/KMC_logo.png');" aria-label="Logo"></a>
                <a href="/" class="text-white text-lg font-bold">Taste Treasures</a>
            </div>

            <!-- Hamburger Menu (Mobile) -->
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
        </div>
    </nav>

    <!-- Contact Us Section -->
    <div class="container mx-auto mt-12 px-4 mb-8">
        <h1 class="text-4xl font-extrabold text-center mb-12 text-green-700">Contact Us</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h2 class="text-2xl font-bold mb-4 text-green-700">Get In Touch</h2>

                <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Name</label>
                        <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Message</label>
                        <textarea name="message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition font-bold">Send Message</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-xl">
                <h2 class="text-2xl font-bold mb-4">Our Contact Details</h2>
                <p class="mb-4 text-lg"><i class="fas fa-map-marker-alt mr-2"></i> 123 Main Street, Kandy, Sri Lanka</p>
                <p class="mb-4 text-lg"><i class="fas fa-envelope mr-2"></i> support@tastetreasures.com</p>
                <p class="mb-4 text-lg"><i class="fas fa-phone mr-2"></i> +94 71 234 5678</p>

                <h3 class="text-xl font-bold mt-6">Follow Us</h3>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-white text-2xl hover:text-yellow-400 transition"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white text-2xl hover:text-yellow-400 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white text-2xl hover:text-yellow-400 transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white text-2xl hover:text-yellow-400 transition"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-green-600 py-4">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2024 Taste Treasures. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Hide loader after page loads
        window.addEventListener("load", function () {
            document.getElementById("page-loader").style.display = "none";
        });

        // Mobile menu toggle
        document.getElementById("hamburgerButton").addEventListener("click", function () {
            document.getElementById("mobileMenu").classList.toggle("hidden");
        });
    </script>

</body>
</html>
