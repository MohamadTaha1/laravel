{{-- hero.blade.php --}}
<div class="flex flex-wrap items-center bg-blue-200 dark:bg-gray-900">
    <div class="w-full md:w-1/2 px-4 py-12">
        <h1 class="text-4xl md:text-5xl font-bold text-black dark:text-white">Find, book, rent a car—quick and super easy!</h1>
        <p class="text-md text-gray-800 dark:text-gray-300 mt-4">
            Streamline your car rental experience with our effortless booking process.
        </p>
        <button class="mt-6 px-6 py-3 bg-blue-500 text-white rounded-full font-medium hover:bg-blue-700 transition duration-300">
            <a href="{{ route('login') }}"> Explore Cars</a>
        </button>
    </div>
    <div class="w-full md:w-1/2 px-4 py-12 flex justify-center">
        <div class="relative w-3/4 h-60 md:h-auto">
            <img src="/hero.png" alt="hero" class="max-w-full h-auto rounded-lg " style="object-fit: cover;"/>
        </div>
    </div>
</div>

<script>
    function handleScroll() {
        const nextSection = document.getElementById('discover');

        if (nextSection) {
            nextSection.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
