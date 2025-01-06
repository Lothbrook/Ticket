<x-guest-layout>
        <div class="min-h-screen flex flex-col justify-center items-center">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2 animate-fade-in">Bienvenue</h1>
                    <p class="text-gray-500 animate-fade-in-delay">Connectez-vous pour continuer</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Input -->
                    <div class="relative group">
                        <div class="absolute left-3 top-3 text-gray-400 group-focus-within:text-blue-600 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="gray">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <x-text-input 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="Votre adresse email"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg 
                            transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:scale-105"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password Input -->
                    <div class="relative group">
                        <div class="absolute left-3 top-3 text-gray-400 group-focus-within:text-blue-600 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="gray">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <x-text-input 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="Votre mot de passe"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg 
                            transition-all duration-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:scale-105"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="form-checkbox text-blue-600 rounded focus:ring-blue-500"
                            >
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <x-primary-button 
                            class="py-3 px-8 bg-blue-950 text-white rounded-lg font-semibold 
                            hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 
                            transition-all duration-300 transform hover:scale-105 active:scale-95"
                        >
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.6s ease-out;
            }
            .animate-fade-in-delay {
                animation: fadeIn 0.6s ease-out 0.3s backwards;
            }
            .min-h-screen {
                min-height: 80vh;
            }
        </style>
</x-guest-layout>