@props(['name'])

<label for="{{ $name }}" class="block">
    {{ ucwords($name)  }}
</label>