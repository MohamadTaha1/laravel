<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50']) }}>
    {{ $slot }}
</button>
