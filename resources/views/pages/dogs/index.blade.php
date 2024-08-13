<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- logo --}}
        <link rel="shortcut icon" href="{{asset('image/main-logo.jpg')}}" type="image/x-icon">

        {{-- Icon Link --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>

        {{--  --}}
        <style>
            /* Ensure list styles are displayed properly */
            .ck-content ul, .ck-content ol {
                list-style: initial;
                margin: 0 0 1em 1.5em;
            }
            .ck-content ul {
                list-style-type: disc;
            }
            .ck-content ol {
                list-style-type: decimal;
            }
            .favorite {
                color: red;
            }
            .active {
                background-color: #48b194;
                color: whitesmoke;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div>
            @include('layouts.navigation')
            <div>
                <div style="background-image: url({{ url('image/dogbanner.jpeg') }});">
                    <div class="h-[487px] relative max-w-screen-xl mx-auto">
                        <div class="absolute top-20 right-0">
                            <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-[#192a82] from-[#828ecf]">Making healthier dog <br> food a reality.</span>
                            </h1>
                            <p class="text-2xl text-gray-100 mt-4">High quality ingredients, balanced by experts.</p>
                        </div>
                        <nav class="absolute bottom-[-20px] right-0">
                            <div class="flex justify-end gap-5">
                                <div class="bg-white py-2 px-8 rounded-xl">
                                    <a href="/pages/dogs/allProduct">
                                        <h1 class="mb-2 font-bold">Dogs</h1>
                                        <img src="{{asset('image/dog.png')}}" alt="" class="w-32 object-cover">
                                    </a>
                                </div>
                                <div class="bg-white py-2 px-8 rounded-xl">
                                    <a href="/pages/cats/allProduct">
                                        <h1 class="mb-2 font-bold">Cats</h1>
                                        <img src="{{asset('image/cat.png')}}" alt="" class="w-32 object-cover">
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="mt-20">
                    <h1 class="text-4xl font-bold text-center font-serif">Find Products For Your Dogs</h1>
                    <div class="flex justify-center gap-5 mt-5">
                        <a href="/pages/dogs/allProduct" class="border border-[#48b194] px-5 py-1.5 rounded-full" id="all-link">
                            <h1 class="font-medium">All</h1>
                        </a>
                        <a href="/pages/dogs/foodPage" class="border border-[#48b194] px-5 py-1.5 rounded-full" id="food-link">
                            <h1 class="font-medium">Food</h1>
                        </a>
                        <a href="/pages/dogs/healthcarePage" class="border border-[#48b194] px-5 py-1.5 rounded-full" id="healthcare-link">
                            <h1 class="font-medium">Healthcare</h1>
                        </a>
                        <a href="/pages/dogs/toyPage" class="border border-[#48b194] px-5 py-1.5 rounded-full" id="toy-link">
                            <h1 class="font-medium">Toy</h1>
                        </a>
                        <a href="/pages/dogs/treatPage" class="border border-[#48b194] px-5 py-1.5 rounded-full" id="treat-link">
                            <h1 class="font-medium">Treat</h1>
                        </a>
                    </div>
                </div>   
            </div>
            <!-- Page Content -->
            <main class="max-w-screen-xl mx-auto my-10">
                @yield('content')
            </main>

            @include('components.footer')
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script src="asset('javaScript/costom.js')"></script>
        <script>
            // Function to get the current page
            function setActiveLink() {
              const path = window.location.pathname;
          
              // Remove the active class from all links
              document.querySelectorAll('a').forEach(link => {
                link.classList.remove('active');
              });
          
              // Add the active class to the current page link
              if (path.includes('pages/dogs/allProduct')) {
                document.getElementById('all-link').classList.add('active');
              } else if (path.includes('/pages/dogs/foodPage')) {
                document.getElementById('food-link').classList.add('active');
              } else if (path.includes('/pages/dogs/healthcarePage')) {
                document.getElementById('healthcare-link').classList.add('active');
              } else if (path.includes('/pages/dogs/toyPage')) {
                document.getElementById('toy-link').classList.add('active');
              } else if (path.includes('/pages/dogs/treatPage')) {
                document.getElementById('treat-link').classList.add('active');
              }
            }
          
            // Call the function when the page loads
            window.onload = setActiveLink;
        </script>
    </body>
</html>
