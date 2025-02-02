<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            
            <!-- Logo Section -->
            <div class="flex justify-center mb-6">
                <x-authentication-card-logo />
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Input -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" class="text-gray-700 font-semibold" />
                    <x-input id="name" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <!-- Email Input -->
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-semibold" />
                    <x-input id="email" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <!-- Password Input -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                    <x-input id="password" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                        type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-gray-700 font-semibold" />
                    <x-input id="password_confirmation" class="block mt-2 w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" 
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <!-- Terms & Privacy Policy -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4 flex items-start">
                        <input id="terms" name="terms" type="checkbox" required 
                            class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring focus:ring-green-300">
                        <label for="terms" class="ml-2 text-sm text-gray-700">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-green-600 underline hover:text-green-800">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-green-600 underline hover:text-green-800">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </label>
                    </div>
                @endif

                <!-- Register Button & Already Registered -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-green-600 hover:underline">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
