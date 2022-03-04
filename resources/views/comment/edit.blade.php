<x-layout>
    <div class="flex justify-center">
        <div class="w-1/5">
            <h1 class="font-semibold mb-10">Edit comment on {{ $comment->post->title }}</h1>

            <form method="POST" action="/comment/{{ $comment->id }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <x-form.text-area name="body">{{ old('excerpt', $comment->body) }}</x-form.text-area>
                <x-form.button text="update" />
            </form>
        </div>
    </div>
</x-layout>