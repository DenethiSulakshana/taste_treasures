<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            
            <!-- Logo Section -->
            <div class="flex justify-center mb-6">
                <x-authentication-card-logo />
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-semibold" />
                    <x-input id="email" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <!-- Password Input -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                    <x-input id="password" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                        type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mt-4">
                    <input id="remember_me" type="checkbox" name="remember" class="text-green-600 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700"> {{ __('Remember me') }} </label>
                </div>

                <!-- Login Button & Forgot Password -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
