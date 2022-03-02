@auth
<x-panel>
    <form method="POST" action="/posts/{{ $post->slug }}/comments">
        @csrf

        <header class="flex items-center">
            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" 
                 alt="" width="60" heigh="60" class="rounded-full">
            <h2 class="ml-4">
                Want to participate?
            </h2>
        </header>

        <div class="mt-5">
            <textarea name="body" 
                      class="w-full text-sm focus:outline-none focus:ring" 
                      row="5" placeholder="Say your piece" required></textarea>

            <x-validation-error>
                You can't submit a comment without a comment
            </x-validation-error>
        </div>

        <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
            <x-form.button text="submit"/>
        </div>

    </form>
</x-panel>

@else
<p>
    <a href="/register" class="text-blue-500 font-bold hover:text-blue-700">
        Register
    </a>
    or
    <a href="/login" class="text-blue-500 font-bold hover:text-blue-700">
        Log In
    </a>
    to leave a comment
</p>
@endauth