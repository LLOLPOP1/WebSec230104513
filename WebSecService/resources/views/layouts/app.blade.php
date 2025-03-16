<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ✅ تضمين Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ✅ إضافة أنماط مخصصة للوضع المظلم --}}
    <script>
        tailwind.config = {
            darkMode: 'class'
        };
    </script>
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white transition-all duration-300">

    {{-- ✅ شريط التنقل (Navbar) --}}
    <header class="bg-blue-600 dark:bg-gray-800 text-white py-4 shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <a href="{{ url('/') }}" class="text-xl font-semibold hover:underline">My Website</a>
            
            {{-- زر تفعيل الوضع المظلم --}}
            <button id="darkModeToggle" class="bg-white text-gray-900 px-3 py-1 rounded shadow-md dark:bg-gray-700 dark:text-white transition-all">
                🌙 Dark Mode
            </button>
        </div>
    </header>

    {{-- ✅ المحتوى الرئيسي --}}
    <main class="container mx-auto my-8 px-4">
        @yield('content')
    </main>

    {{-- ✅ الفوتر --}}
    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} WebSEC. All rights reserved.</p>
    </footer>

    {{-- ✅ سكريبت لتفعيل الوضع المظلم --}}
    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const htmlElement = document.documentElement;

        darkModeToggle.addEventListener('click', () => {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });

        // التحقق من الوضع المخزن في Local Storage
        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.classList.add('dark');
        }
    </script>

</body>
</html>
