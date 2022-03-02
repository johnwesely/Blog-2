<x-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title" required />
            <x-form.text-area name="excerpt" />
            <x-form.text-area name="body" />
            <x-form.input name="thumbnail" type="file" />

            <x-form.field>
                <x-form.label name="category_id" />

                <select class="border border-gray-400 p-2 w-full" 
                        name="category_id" 
                        value="{{ old('category_id') }}" 
                        required>
                    @php
                    $categories = \App\Models\Category::all()
                    @endphp

                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>
                        {{ ucwords($category->name) }}
                    </option>
                    @endforeach

                </select>

                <x-form.validation-error name="category_id" />
            </x-form.field>

            <x-form.button text="publish" />
        </form>
    </x-setting>
</x-layout>