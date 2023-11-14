<div>
    <div>
        <x-head.h3>Описание</x-head.h3>
        @if ($showEdit)
            @error('modelContent') <div class="text-red-500">{{ $message }}</div> @enderror
        @endif
        <div x-data="{ content: @entangle('modelContent') }" class="mb-3">
            <div x-on:blur="content = $event.target.innerHTML" 
                class="text-gray-600 text-sm p-1 {{ $showEdit ? 'border' : '' }}  rounded focus:outline-none focus:border-blue-400 focus:border-2" 
                contentEditable="{{ $showEdit ? 'true' : 'false' }}">{!! $model->content !!}</div>
        </div>
    </div>
	<div class="grid grid-cols-2 items-center mb-2">
		<div><x-head.h2>Файлы</x-head.h2></div>
		<div>
			<x-button.create class="w-full" wire:click="openAddFile">Добавить</x-button.create>
            <x-modal-wire.dropdown wire:model="showAddFile" maxWidth="sm">
            	<form wire:submit="saveFile" class="flex-col space-y-2">
                    <div>
                        <input type="file" wire:model="addFile" class="text-sm" required>
                        @error('addFile') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div wire:loading wire:target="addFile">{{ __('Uploading...') }}</div>
            		<x-button.create class="text-sm" type="submit">{{ __('Add') }}</x-button.create>
                    <x-button.secondary class="text-sm" wire:click="cancelAddFile">{{ __('Cancel') }}</x-button.secondary>
            	</form>
            </x-modal-wire.dropdown>
		</div>
	</div>
	@foreach($files as $file)
		<div><x-item.file :item="$file" /></div>
	@endforeach
    <x-modal-wire.dialog wire:model.defer="showDelFile" type="warn" maxWidth="md">
        <x-slot name="title"><span class="grow">{{ __('Delete File') }}</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelFile" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
        <x-slot name="content">
            <div class="flex-col space-y-2">
                <x-input.label class="text-lg font-medium">Вы действительно хотите удалить файл? 
                    <div class="text-black">{{ $delFile['name'] }}</div>
                </x-input.label>
                <x-button.secondary @click="show = false" wire:click="cancelDelFile">Отменить</x-button.secondary>
                <x-button.danger wire:click="deleteUserFile({{ $delFile['id'] }})">{{ __('Delete')}}</x-button.danger>
            </div>                            
        </x-slot>
    </x-modal-wire.dialog>

</div>