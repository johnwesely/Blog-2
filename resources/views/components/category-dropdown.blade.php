<x-dropdown>
    <x-slot name="trigger">
        <!-- trigger fromm dropdown blade to activate dropdown menu -->
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{ isset($currentCategory) ? $currentCategory->name : 'Categories'  }}
            <x-arrow-icon class="absolute pointer-events-none transform -rotate-90" />
        </button>
    </x-slot>

    <!-- dropdown container -->
    <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}"
                     :active="request()->routeIs('home')">
        All
    </x-dropdown-item>

    @foreach ($categories as $category)
    <!-- hacky way of combing category with serach request, ignore pagination -->
    <x-dropdown-item href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}" 
                     :active="isset($currentCategory) && $currentCategory->is($category)">
        {{ ucwords($category->name) }}
    </x-dropdown-item>
    @endforeach

</x-dropdown>