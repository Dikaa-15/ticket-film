<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#02003C',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(2, 0, 60, 0.2);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4 font-sans">
    <div class="w-full max-w-md">
        <!-- Toggle Card -->
        <div class="flex bg-white rounded-t-lg overflow-hidden shadow-sm">
            <button id="signin-tab"
                class="flex-1 py-4 px-6 text-center font-medium text-primary border-b-2 border-primary">
                Sign In
            </button>
            <button id="signup-tab"
                class="flex-1 py-4 px-6 text-center font-medium text-gray-500 border-b-2 border-transparent">
                Sign Up
            </button>
        </div>

        <!-- Forms Container -->
        <div class="bg-white rounded-b-lg shadow-md p-8">
            <!-- Sign In Form (visible by default) -->
            <form id="signin-form" class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="input-field w-full px-4 py-2 border border-gray-300 rounded-md focus:border-primary @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                        class="input-field w-full px-4 py-2 border border-gray-300 rounded-md focus:border-primary @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="mt-2 text-right">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-primary hover:text-primary/80">Forgot password?</a>
                        @endif
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 bg-primary text-white font-medium rounded-md hover:bg-primary/90 transition">
                    Sign In
                </button>
            </form>

            <!-- Sign Up Form -->
            <form id="signup-form" class="space-y-6 hidden" method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                        class="input-field w-full px-4 py-2 border border-gray-300 rounded-md focus:border-primary @error('name') border-red-500 @enderror">
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="signup-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="signup-email" name="email" type="email" value="{{ old('email') }}" required
                        class="input-field w-full px-4 py-2 border border-gray-300 rounded-md focus:border-primary @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="signup-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="signup-password" name="password" type="password" required
                        class="input-field w-full px-4 py-2 border border-gray-300 rounded-md focus:border-primary @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 bg-primary text-white font-medium rounded-md hover:bg-primary/90 transition">
                    Create Account
                </button>
            </form>
        </div>

        <!-- Alternative Sign In Options -->
        <div class="mt-6 text-center text-sm text-gray-600">
            <p id="toggle-text">Don't have an account? <a href="#" id="toggle-link"
                    class="text-primary font-medium hover:text-primary/80">Sign up</a></p>
        </div>
    </div>

    <script>
        const signinTab = document.getElementById('signin-tab');
        const signupTab = document.getElementById('signup-tab');
        const signinForm = document.getElementById('signin-form');
        const signupForm = document.getElementById('signup-form');
        const toggleLink = document.getElementById('toggle-link');
        const toggleText = document.getElementById('toggle-text');

        // Tab switching
        signinTab.addEventListener('click', () => {
            signinTab.classList.add('border-primary', 'text-primary');
            signinTab.classList.remove('border-transparent', 'text-gray-500');
            signupTab.classList.add('border-transparent', 'text-gray-500');
            signupTab.classList.remove('border-primary', 'text-primary');
            signinForm.classList.remove('hidden');
            signupForm.classList.add('hidden');
            toggleText.innerHTML = 'Don\'t have an account? <a href="#" id="toggle-link" class="text-primary font-medium hover:text-primary/80">Sign up</a>';
        });

        signupTab.addEventListener('click', () => {
            signupTab.classList.add('border-primary', 'text-primary');
            signupTab.classList.remove('border-transparent', 'text-gray-500');
            signinTab.classList.add('border-transparent', 'text-gray-500');
            signinTab.classList.remove('border-primary', 'text-primary');
            signupForm.classList.remove('hidden');
            signinForm.classList.add('hidden');
            toggleText.innerHTML = 'Already have an account? <a href="#" id="toggle-link" class="text-primary font-medium hover:text-primary/80">Sign in</a>';
        });

        // Link switching
        toggleLink.addEventListener('click', (e) => {
            e.preventDefault();
            if (signinForm.classList.contains('hidden')) {
                signinTab.click();
            } else {
                signupTab.click();
            }
        });
    </script>
</body>

</html>