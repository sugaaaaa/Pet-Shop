<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{asset('image/main-logo.jpg')}}" type="image/x-icon">
    <title>PetSo - Sign Up</title>
</head>
<body>
    <section class="w-full h-[1034px] flex items-center justify-center bg-cover bg-[url('image/backgroundSignup.jpeg')]">
        <div class="w-[580px] bg-slate-50 rounded-2xl p-10">
            <form class="w-full" method="POST" action="{{ route('register') }}">
                @csrf
                <h1 class="text-3xl font-bold text-center mb-10">Sign Up</h1>

                {{-- Name --}}
                <div class="mb-5">
                    <x-input-label for="name" :value="__('Name')" class="block mb-2 text-sm font-medium text-gray-900"/>
                    <x-text-input id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                {{-- Phone --}}
                <div class="mb-5">
                    <x-input-label for="phone" :value="__('Phone Number')" class="block mb-2 text-sm font-medium text-gray-900"/>
                    <x-text-input id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="phone" :value="old('phone')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <x-input-label for="password" :value="__('Password')" class="block mb-2 text-sm font-medium text-gray-900"/>

                    <x-text-input id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />        
                </div>

                <!-- Confirm Password -->
                <div class="mb-5">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block mb-2 text-sm font-medium text-gray-900"/>

                    <x-text-input id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- Remember Me  --}}
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900">I agree to the <a href="#" class="font-semibold text-[#526BEE]">terms of service</a> and <a href="#" class="font-semibold text-[#526BEE]">privacy policy</a></label>
                </div>

                {{-- Submit --}}
                <div class="mb-10">
                    <button class="text-white bg-blue-700 w-[500px] hover:bg-blue-800 py-2.5 font-medium rounded-lg">
                        {{ __('Sign Up') }}
                    </button>
                </div>

                <div class="mb-5 flex justify-between items-center">
                    <hr class="w-[35%]">
                    <p>Or Login with</p>
                    <hr class="w-[35%]">
                </div>

                {{-- Sign up with social media --}}
                <div class="flex justify-between">
                    <div class="items-center justify-center gap-3 flex border rounded-md w-[150px] h-[50px] hover:bg-[#5B96A6] hover:text-white">
                        <i class="fa-brands fa-google text-2xl"></i>
                        <label for="google" class="font-semibold">Google</label>
                    </div>
                    <div class="items-center justify-center gap-3 flex border rounded-md w-[150px] h-[50px] hover:bg-[#5B96A6] hover:text-white">
                        <i class="fa-brands fa-facebook text-2xl"></i>
                        <label for="google" class="font-semibold">Facebook</label>
                    </div>
                    <div class="items-center justify-center gap-3 flex border rounded-md w-[150px] h-[50px] hover:bg-[#5B96A6] hover:text-white">
                        <i class="fa-brands fa-apple text-2xl"></i>
                        <label for="google" class="font-semibold">Apple Id</label>
                    </div>
                </div>
                {{-- <p class="mt-10 text-center">Already have an account? <a href="/login" class="font-semibold text-[#526BEE]">Login</a></p> --}}
                <div class="mt-5 text-center ">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </form>
            
        </div>
    </section>

</body>
</html>
