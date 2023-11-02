@props (['item','model'])
<div class="flex flex-row border-b p-1">
	<div class="mx-1 px-1">
		@if ($item->timeEvent_id == $model->id)
		<div class="grid grid-cols-2 items-center">
			<div class="flex items-center">
				<x-button.icon-minus wire:click="delVisit({{ $item->id }})" />
			</div>
			<div class="bg-neutral-300 text-center font-bold text-green-700">Б</div>
		</div>
		@else
		<div class="grid grid-cols-2 items-center">
			<div class="flex items-center">
				<x-button.icon-plus wire:click="addVisit({{ $item->id }})" />
			</div>
			<div class="bg-neutral-300 text-center font-bold text-red-700">Н</div>
		</div>
		@endif
	</div>
	<div>{{ $item->surname }} {{ $item->name }}</div> 
</div>