<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post->title)" required />
            <x-form.text-area name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.text-area>
            <x-form.text-area name="body">{{ old('body', $post->body )}}</x-form.text-area>
            <div class="mb-6">
                <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl" width="200">
            </div>

            <x-form.field>
                <x-form.label name="category_id" label="Category ID" />

                <select class="border border-gray-400 p-2 w-full" 
                        name="category_id" 
                        required>
                    @php
                    $categories = \App\Models\Category::all()
                    @endphp

                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                            {{ old('category_id') == $category->id ? 'selected' : ''}}>
                        {{ ucwords($category->name) }}
                    </option>
                    @endforeach

                </select>

                <x-form.validation-error name="category_id" />
            </x-form.field>

            <x-form.field>
                 <div class="flex justify-start flex-nowrap">
                    <x-form.label name="save_as_draft" label="Save as Draft" />
                        <input class="border border-gray-200 p-2 w-full rounded-md mr-auto" 
                               type="checkbox"
                               name="save_as_draft" 
                               {{ ! $post->published ? 'checked' : '' }} />
                    <x-form.validation-error name="save_as_draft" />
                </div>
            </x-form.field>
            <x-form.button text="update" />
        </form>
    </x-setting>
</x-layout>