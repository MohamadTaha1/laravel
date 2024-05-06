{{-- Custom Filter Component --}}
<div class="w-fit">
    <form action="{{ route('your_filter_route') }}" method="GET">
        <select name="filter" onchange="this.form.submit()" class="custom-filter__btn">
            @foreach ($options as $option)
                <option value="{{ $option->value }}" {{ request('filter') == $option->value ? 'selected' : '' }}>
                    {{ $option->title }}
                </option>
            @endforeach
        </select>
    </form>
</div>
