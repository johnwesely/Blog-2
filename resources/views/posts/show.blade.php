<x-layout>
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-left lg:pt-14 mb-10">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">

                <p class="mt-4 block text-gray-400 text-xs">
                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>
                <p class="block text-gray-400 text-xs">
                    Viewed {{ $post->view_count }} times
                </p>

                @auth
                <form method="POST" action="/favorites/{{ $post->id }}">
                    @csrf
                    @if(auth()->user()->favorites()
                              ->where('user_id', auth()->user()->id)
                              ->where('post_id', $post->id)
                              ->exists())

                    @method('DELETE')
                    <button class="text-blue-500 text-s mt-2">
                        Add to Favorites
                    </button> 
                    @else

                    @method('POST')
                    <button class="text-blue-500 text-s mt-2">
                        Remove From Favorites
                    </button> 

                    @endif
                </form>
                @endauth

                <div class="flex lg:justify-left text-sm mt-6">
                    <a href="/author={{ $post->author->username }}">
                    <img src="{{ asset('storage/' . $post->author->profile_image) }}" alt="profile image thumbnail"
                         width="100" height="100" class="rounded full flex-0">
                    <div class="ml-3 text-left">
                        <h5 class="font-bold">
                            {{ $post->author->name }}
                        </h5>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="/" class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <x-arrow-icon class="pointer-events-none transform -rotate-180"/>
                        <p>Back to Posts</p>
                    </a>

                    <div class="space-x-2">
                        <x-category-button :category="$post->category" />
                    </div>
                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                    {{ $post->title }}
                </h1>

                <div class="space-y-4 lg:text-lg leading-loose">
                    {!! $post->body !!}
                </div>
            </div>

            <section class="col-span-8 col-start-5 mt-10 space-y-5">
                @include ('posts._add-comment-form')

                @foreach ( $post->comments as $comment)
                    <x-post-comment :comment="$comment" />
                @endforeach
            </section>
        </article>
    </main>

</x-layout>