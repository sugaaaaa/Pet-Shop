<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('image/main-logo.jpg') }}" type="image/x-icon">
    <title>PetSo - Login</title>
</head>
<body>
    <section class="w-full h-[1034px] flex items-center justify-center bg-cover bg-[url('image/backgroundSignup.jpeg')]">
        <div class="w-[580px] bg-slate-50 rounded-2xl p-10">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="text-3xl font-bold text-center mb-10">Login</h1>
                <!-- Phone Number -->
                <div class="mb-5">
                    <x-input-label for="phone" :value="__('Phone Number')" />
                    <x-text-input id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="phone" :value="old('phone')" required autofocus />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
    
                <!-- Password -->
                <div class="mb-5">
                    <x-input-label for="password" :value="__('Password')" />
    
                    <x-text-input id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
    
                <!-- Remember Me -->
                <div class="flex justify-between w-full mb-5">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" name="remember">
                        <span class="ms-2 text-sm font-medium text-gray-900">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
    
                <div class="flex items-center justify-end mb-10">
                    <button class="text-white bg-blue-700 w-[500px] hover:bg-blue-800 py-2.5 font-medium rounded-lg">
                        {{ __('Log in') }}
                    </button>
                </div>

                <div class="mb-5 flex justify-between items-center">
                    <hr class="w-[35%]">
                    <p>Or Login with</p>
                    <hr class="w-[35%]">
                </div>

                {{-- Sign up with social media --}}
                <div class="flex justify-between">
                    <a href="{{ route('social.login', 'google') }}" class="items-center justify-center gap-3 flex border rounded-md w-[150px] h-[50px] hover:bg-[#5B96A6] hover:text-white">
                        <i class="fa-brands fa-google text-2xl"></i>
                        <label for="google" class="font-semibold">Google</label>
                    </a>
                    <a href="{{ route('social.login', 'facebook') }}" class="items-center justify-center gap-3 flex border rounded-md w-[150px] h-[50px] hover:bg-[#5B96A6] hover:text-white">
                        <i class="fa-brands fa-facebook text-2xl"></i>
                        <label for="facebook" class="font-semibold">Facebook</label>
                    </a>
                    <a href="{{ route('social.login', 'apple') }}" class="items-center justify-center gap-3 flex border rounded-md w-[150px] h-[50px] hover:bg-[#5B96A6] hover:text-white">
                        <i class="fa-brands fa-apple text-2xl"></i>
                        <label for="apple" class="font-semibold">Apple Id</label>
                    </a>
                </div>
                <div class="mt-5 text-center ">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Do not have account yet?') }}
                    </a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
