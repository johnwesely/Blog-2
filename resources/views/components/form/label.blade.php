@props(['name', 'label' => $name])

<label for="{{ $name }}" class="block">
    {{ ucwords($label)  }}
</label>