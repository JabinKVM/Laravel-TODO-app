<x-guest-layout>

<div class="min-h-screen flex">

    <!-- Left Side -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-700 via-purple-700 to-pink-600 items-center justify-center">

        <div class="text-center text-white px-10">

            <h1 class="text-6xl font-bold mb-6">
                TodoPro
            </h1>

            <p class="text-xl opacity-90">
                Organize your work, boost productivity,
                and accomplish your goals.
            </p>

            <div class="mt-10 space-y-4 text-left max-w-md mx-auto">

                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl">
                    ✓ Manage Tasks Efficiently
                </div>

                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl">
                    ✓ Track Priorities
                </div>

                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl">
                    ✓ Monitor Progress
                </div>

            </div>

        </div>

    </div>

    <!-- Right Side -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-100">

        <div class="w-full max-w-md">

            <div class="bg-white shadow-2xl rounded-3xl p-10">

                <div class="text-center mb-8">

                    <h2 class="text-4xl font-bold text-gray-800">
                        Welcome Back
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Sign in to continue
                    </p>

                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5">

                        <label class="block text-gray-700 mb-2">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               required autofocus>

                        @error('email')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-5">

                        <label class="block text-gray-700 mb-2">
                            Password
                        </label>

                        <input type="password"
                               name="password"
                               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               required>

                        @error('password')
                            <div class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="flex justify-between items-center mb-6">

                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="remember"
                                   class="mr-2">
                            Remember Me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-indigo-600 hover:underline">
                                Forgot Password?
                            </a>
                        @endif

                    </div>

                    <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition">
                        Sign In
                    </button>

                    <div class="text-center mt-6">

                        <span class="text-gray-500">
                            Don't have an account?
                        </span>

                        <a href="{{ route('register') }}"
                           class="text-indigo-600 font-semibold hover:underline">
                            Register
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</x-guest-layout>