@props(['comment'])
<x-panel class="bg-gray-50">
    <article class="flex space-x-auto">
        <div class="flex space-x-4">
            <div class="flex-shrink-0">
                <img src="{{ asset('storage/' . $comment->author->profile_image) }}" alt="" width="60" heigh="60" class="rounded-xl">
            </div>
            <div>
                <header class="mb-4">
                    <h3 class="font-bold">
                        {{ $comment->author->username  }}
                    </h3>
                    <p class="text-xs">Posted
                        <time>{{ $comment->created_at->format('F j, Y, g a')  }}</time>
                    </p>
                </header>
                <P>
                    {{ $comment->body  }}
                </P>
            </div>
        </div>

        @if ( auth()->user() && $comment->author->username = auth()->user()->username)
        <div class="ml-auto">
            <a href="/comment/{{ $comment->id }}/edit">
                <img src="https://img.icons8.com/material-outlined/24/000000/edit--v1.png" />
            </a>
        </div>
        @endif

    </article>
</x-panel>