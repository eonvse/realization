@props (['item'])
<div class="flex items-center border-b text-xs hover:bg-gray-200">
	<a href="{{ $item->isLocal ? url('storage/'.$item->url) : $item->url }}" class="grow border-r p-1">{{ $item->name }}</a>
	<div class="p-1 flex items-center">
        <x-button.icon-del wire:click="showDeleteFile({{ $item->id }})" title="Удалить"/>
	</div>
</div>