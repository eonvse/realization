@props(['editable'=>'false'])

<div x-data="{ content: @entangle($attributes->wire('model')) }" class="mb-3">
    <div x-on:blur="content = $event.target.innerHTML" 
        class="text-gray-600 text-sm p-1 {{ $editable=='true' ? 'border border-gray-300 shadow bg-white' : '' }}  rounded focus:outline-none focus:border-blue-400 focus:border-2" 
        contentEditable="{{ $editable }}">
        {{ $slot }}
    </div>
</div>