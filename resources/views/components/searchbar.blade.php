{{-- Search Bar Component --}}
<form action="{{ route('your_search_route') }}" method="GET" class="searchbar">
    {{-- Manufacturer Dropdown --}} 
    <div class="searchbar__item">
        <select name="manufacturer" class="searchbar__input">
            @foreach ($manufacturers as $manufacturer)
                <option value="{{ $manufacturer }}">{{ $manufacturer }}</option>
            @endforeach
        </select>
    </div>
    {{-- Model Input --}}
    <div class="searchbar__item">
        <input
            type="text"
            name="model"
            placeholder="M8 sport..."
            class="searchbar__input"
            value="{{ request('model') }}"
        />
    </div>
    <button type="submit" class="searchbar__button">Search</button>
</form>
