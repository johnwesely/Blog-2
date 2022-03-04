@props(['name', 'label' => $name])

<x-form.field>
    <x-form.label name="{{ $label }}" />
    <input class="border border-gray-200 p-2 w-full rounded-md" 
           name="{{ $name }}" 
           {{ $attributes(['value' => old($name)]) }}>
    <x-form.validation-error name="{{ $name }}" />
</x-form.field>