<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - E-library</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;600;600;600;800&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/tailwind.output.css" />

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="/assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="relative flex items-center min-h-screen p-6 bg-gray-50">

        <div class="flex-1 h-full max-w-md mx-auto space-y-2 overflow-hidden ">
            <div class="flex flex-col overflow-y-auto bg-white rounded-lg shadow-sm max-h-max">
                <div class="h-32 pt-6 -mb-6 md:h-auto">
                    <h2 class="mb-2 overflow-hidden font-mono font-black text-center uppercase">Books Archive</h2>
                    <img aria-hidden="true" class="object-cover w-24 h-16 mx-auto rounded-sm"
                        src="{{ asset('img/logo.png') }}" alt="Office" />
                </div>
                <div class="flex items-center justify-center px-6 pt-0 pb-6 sm:p-12 sm:pt-0">
                    <div class="w-full">
                        <h1 class="my-4 text-xl font-semibold text-gray-600 dark:text-gray-200">
                            Login
                        </h1>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-600">Email</span>
                                <input name="username" type="text" value="{{ old('username') }}"
                                    class="block w-full p-2 mt-1 text-sm border-b-2 form-input focus:border-pink-700 focus:outline-none"
                                    placeholder="JaneDoe" />
                                @error('username')
                                    <span class="text-sm font-normal text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-600">Password</span>
                                <input name="password" value="{{ old('password') }}"
                                    class="block w-full p-2 mt-1 text-sm border-b-2 form-input focus:border-pink-700 focus:outline-none"
                                    placeholder="***************" type="password" />
                                @error('password')
                                    <span class="text-sm font-normal text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <p class="text-right">
                                <a class="text-sm font-medium text-right text-pink-700 hover:underline"
                                    href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            </p>

                            <!-- You should use a button here, as the anchor is only used for the example  -->
                            <button type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-pink-700 border border-transparent rounded-lg focus:shadow-outline-green hover:bg-pink-700 focus:outline-none active:bg-pink-700"
                                href="/index.html">
                                Log in
                            </button>
                        </form>
                        <p class="mt-3 text-center">
                            <span>New user</span>
                            <a class="text-sm font-medium text-pink-700 hover:underline" href="{{ route('register') }}">
                                Create account
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-2 mx-auto text-center bg-white rounded-md shadow ">
                <p>Designed and Developed by <a href="https://bowofade.com" class="font-medium text-pink-600"
                        target="_blank">Networker</a></p>
            </div>
        </div>

    </div>
</body>

</html>
