<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- Style --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- image --}}
    <link rel="shortcut icon" href="{{asset('image/main-logo.jpg')}}" type="image/x-icon">

    {{-- Title --}}
    <title>dashboard</title>
    
    {{-- rich text editor style --}}
    <style>
        /* Ensure list styles are displayed properly */
        .ck-content ul,
        .ck-content ol {
            list-style: initial;
            margin: 0 0 1em 1.5em;
        }
        .ck-content ul {
            list-style-type: disc;
        }
        .ck-content ol {
            list-style-type: decimal;
        }
    
        /* Line clamping styles */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 3.6em; /* Adjust based on line height */
        }
    </style>
</head>

<body>
    <div class="antialiased">
        <x-dash-menu-top />

        <!-- Sidebar -->
        <x-dash-menu-left />

        <main class="p-4 md:ml-64 h-auto pt-20">
                @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

    <script>
        // Auto-hide alert after 3 seconds
        document.addEventListener('DOMContentLoaded', (event) => {
            const alert = document.getElementById('alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>

</html>
     


