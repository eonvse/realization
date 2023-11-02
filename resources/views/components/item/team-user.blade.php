@props (['item'])
<div class="grid grid-cols-3 items-center border-b text-sm hover:bg-gray-200">
	<a href="{{ route('info.user',['id'=>$item->id, 'edit'=>0])}}">
		<div class="border-r p-1 after:content-['_↗']">{{ $item->FIO }}</div>
	</a>
	<div class="col-span-2 flex">
		<div class="grow border-r p-1">info</div>
		<div class="p-1 flex items-center">
    	    <x-button.icon-del wire:click="deleteTeamUser({{ $item->id }})" title="Удалить из группы"/>
		</div>
	</div>
</div>