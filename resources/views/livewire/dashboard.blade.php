<div>
    @include('layouts.navigation')

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-3 p-2 items-center">
                    <div>
                        <x-head.page-wire>Заявки на изменение</x-head.page-wire>
                    </div>
                    <div class="flex space-x-2">
                        <div class="flex-1"><x-input.select-years :items="$yearsZNI" wire:model.live="filter.year"/></div>
                        <div class="flex-1"><x-input.select-status :items="$statuses" wire:model.live="filter.status"/></div>

                    </div>
                    <div class="px-5">
                        <x-button.create class="w-full" wire:click="create" >Новая ЗНИ</x-button.create>
                    </div>
                </div>
                <x-table>
                    <x-slot name="header">
                        <x-table.head scope="col" 
                                        sortable 
                                        wire:click="sortBy('zni')" 
                                        :direction="$sortField === 'zni' ? $sortDirection : null">№ ЗНИ</x-table.head>
                        <x-table.head scope="col"
                                        sortable 
                                        wire:click="sortBy('dateZni')" 
                                        :direction="$sortField === 'dateZni' ? $sortDirection : null">Дата ЗНИ</x-table.head>                        
                        <x-table.head rowspan=2>Инициатор</x-table.head>
                        <x-table.head rowspan=2>Название</x-table.head>
                        <x-table.head  scope="col" rowspan=2 >ДОИ</x-table.head>
                        <x-table.head scope="col" rowspan=2 >Дата ДОИ</x-table.head>
                        <x-table.head scope="col" rowspan=2 >Дата выполнения</x-table.head>
                        <x-table.head rowspan=2>...</x-table.head>

                    </x-slot>
                    <x-slot name="searching">
                        <x-table.head colspan=2>
                            <div class="flex">
                                <x-input.text class="py-0 px-1 text-sm" wire:model.live="search" placeholder="Поиск по № ЗНИ..." />
                                @if (!empty($search))
                                <x-button.icon-cancel wire:click="$set('search', '')" title="Отменить" />
                                @endif
                            </div>    
                        </x-table.head>
                    </x-slot>

                    @forelse($zni as $item)
                    <x-table.row wire:loading.class.delay="bg-red-500" wire:key="{{ $item->id }}">
                        <x-table.cell class="tabular-nums">
                            <a href="{{ route('zni.edit',['id'=>$item->id,'edit'=>0]) }}" class="underline cursor-pointer">{{ $item->zni }}</a>
                        </x-table.cell>
                        <x-table.cell class="tabular-nums">
                            {{ date('d.m.Y', strtotime($item->dateZni)) }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $item->initiator->name }}
                        </x-table.cell>
                        <x-table.cell>
                            <span title="{{ strip_tags($item->content) }}" class="">{{ $item->name }}</span>
                        </x-table.cell>
                        <x-table.cell class="tabular-nums text-gray-400 text-xs">{{ $item->doi }}</x-table.cell>
                        <x-table.cell class="tabular-nums text-gray-400 text-xs">{{ empty($item->dateDoi) ? '' : date('d.m.Y', strtotime($item->dateDoi)) }}</x-table.cell>
                        <x-table.cell class="flex items-center">
                            @if ($item->isDone)
                            <div class="w-4 h-4 bg-green-600 rounded-full"></div>
                            @endif
                            <div class="grow text-center tabular-nums">{{ empty($item->dateDone) ? '' : date('d.m.Y', strtotime($item->dateDone)) }}</div>
                        </x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center">
                                <x-button.icon-edit href="{{ route('zni.edit',['id'=>$item->id]) }}" title="Редактировать"/>
                                <x-button.icon-del wire:click="delete({{ $item->id }})" title="Удалить"/>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="8" class="text-center text-lg font-bold" >Не найдено ни одной заявки</x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-table>
                {{ $zni->links() }}

            </div>
        </div>
    </div>

    <x-sidebar wire:model.defer="showCreate">
        <div class="p-3">
        <div class="flex">
            <span class="w-full grow text-center"><x-head.h2>Новая ЗНИ</x-head.h2></span>
            <x-button.icon-cancel @click="show = false" wire:click="cancelCreate" />
        </div>
        <form wire:submit.prevent="store" class="flex-col">
            <x-input.label>№ ЗНИ</x-input.label>
            @error('newZNI') <div class="text-red-500">{{ $message }}</div> @enderror
            <x-input.text wire:model.live="newZNI" required />
            <x-input.label class="mt-3">Название</x-input.label>
            @error('newName') <div class="text-red-500">{{ $message }}</div> @enderror
            <x-input.text wire:model.live="newName" required />
            <x-input.label class="mt-3">Инициатор</x-input.label>
            @error('newInitiator') <div class="text-red-500">{{ $message }}</div> @enderror
            <x-input.text wire:model.live="newInitiator" list="initiators" required />
            <datalist id="initiators">
                @foreach ($initiators as $initiator)
                <option>{{ $initiator->name }}</option>
                @endforeach
            </datalist>
            <x-input.label class="mt-3">Описание</x-input.label>
            @error('newContent') <div class="text-red-500">{{ $message }}</div> @enderror
            <x-input.textarea wire:model.live="newContent" required /> 
            <x-input.label class="mt-3">Дата ЗНИ</x-input.label>
            @error('newDateZNI') <div class="text-red-500">{{ $message }}</div> @enderror
            <x-input.text type="date" wire:model.live="newDateZNI" required />
            <x-input.label class="mt-3">№ ДОИ</x-input.label>
            @error('newDOI') <div class="text-red-500">{{ $message }}</div> @enderror
            <x-input.text wire:model.live="newDOI" />
            <x-input.label class="mt-3">Дата ДОИ</x-input.label>
            @error('newDateDOI') <div class="text-red-500">{{ $message }}</div> @enderror
            <x-input.text type="date" wire:model.live="newDateDOI" />
            <x-button.create type="submit" class="mt-3">Добавить</x-button.create>
            <x-button.secondary @click="show = false" wire:click="cancelCreate">{{ __('Cancel') }}</x-button.secondary>
        </form>
        </div>
    </x-sidebar>

   <x-modal-wire.dialog wire:model.defer="showDelete" type="warn" maxWidth="md">
            <x-slot name="title"><span class="grow">Удалить ЗНИ</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelete" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
            <x-slot name="content">
                <div class="flex-col space-y-2">
                    <x-input.label class="text-lg font-medium">
                        Вы действительно хотите удалить запись?
                    </x-input.label> 
                    <div class="text-black text-base">{{ $delItem['zni'] }} ({{ $delItem['initiator'] ?? '' }}): {{ $delItem['name'] ?? '' }}. </div>

                    <x-button.secondary @click="show = false" wire:click="cancelDelete">Отменить</x-button.secondary>
                    <x-button.danger wire:click="destroy">{{ __('Delete')}}</x-button.danger>
                </div>                            
            </x-slot>
    </x-modal-wire.dialog>


</div>
