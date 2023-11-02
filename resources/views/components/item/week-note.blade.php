@props (['item'])
<div class="xl:grid xl:grid-cols-5 items-center border-b text-xs hover:bg-gray-200">
	<div class="border-r p-1 col-span-1">{{ $item->created2 }}</div>
	<div class="border-r p-1 col-span-4 flex justify-center">
		<div class="grow">{!! nl2br(e($item->note)) !!}</div>
		<div class="p-1 flex items-center">
    	    <x-button.icon-del wire:click="showDeleteNote({{ $item->id }})" title="Удалить"/>
		</div>
	</div>
</div>