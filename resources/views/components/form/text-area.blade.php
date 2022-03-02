@props(['name'])

<x-form.field>
    <x-form.label name="{{ $name }}" />

    <textarea class="border border-gray-200 p-2 w-full rounded-md" 
              name="{{ $name }}" 
              required>{{ $slot ?? old($name) }}</textarea>

    <x-form.validation-error name="{{ $name }}" />
</x-form.field>