<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Title</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
    <nav class="bg-white dark:bg-gray-800 shadow py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Register</a>
            </div>
        </div>
    </nav>
    @include('components.hero')
    @include('components.cars', ['cars' => $cars])

</body>
</html>
