@props(['name', 'label' => $name, 'published' => 0])

<x-form.field>
    <div class="justify-start flex-nowrap">
        <x-form.label name="{{ $label }}" />
        <input class="border border-gray-200 p-2 w-full rounded-md mr-auto" 
               type="checkbox"
               name="{{ $name }}" 
               {{ $published ? checked : '' }} />
        <x-form.validation-error name="{{ $name }}" />
    </div>
</x-form.field>