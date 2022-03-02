<x-layout>
    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        @if ($posts->count())
        <x-featured-card :post="$posts[0]" />

        @if ($posts->count() > 1)
        <div class="lg:grid lg:grid-cols-2">

            @foreach ($posts->skip(1) as $post)
            <x-card :post="$post" />
            @endforeach

        </div>
        @endif

        {{ $posts->links() }}

        @else
        <p>No posts yet. Come back later for great content</p>
        @endif

    </main>

</x-layout>