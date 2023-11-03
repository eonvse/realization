<div>
    @include('layouts.navigation')

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-3 p-2 items-center">
                    <div>
                        <x-head.page-wire>Заявки на изменение</x-head.page-wire>
                    </div>
                    <div class="px-5">
                        <x-button.create class="w-full" wire:click="create" >Новая ЗНИ</x-button.create>
                    </div>
                    <div>Фильтр по году как основной для представления</div>
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
                        <x-table.head>Инициатор</x-table.head>
                        <x-table.head>Название</x-table.head>
                        <x-table.head  scope="col" >ДОИ</x-table.head>
                        <x-table.head scope="col" >Дата ДОИ</x-table.head>
                        <x-table.head scope="col" >Дата выполнения</x-table.head>
                        <x-table.head>...</x-table.head>

                    </x-slot>
                    <!-- 
                        ['author_id','initiator_id','name','content','zni','dateZni','doi','dateDoi','isDone','dateDone']
                    -->
                    @forelse($zni as $item)
                    <x-table.row wire:loading.class.delay="bg-red-500" wire:key="{{ $item->id }}">
                        <x-table.cell>
                            {{ $item->zni }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ date('d.m.Y', strtotime($item->dateZni)) }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $item->initiator->name }}
                        </x-table.cell>
                        <x-table.cell>
                            <span title="{!! nl2br(e($item->content)) !!}" class="">{{ $item->name }}</span>
                        </x-table.cell>
                        <x-table.cell>{{ $item->doi }}</x-table.cell>
                        <x-table.cell>{{ empty($item->dateDoi) ? '' : date('d.m.Y', strtotime($item->dateDoi)) }}</x-table.cell>
                        <x-table.cell>{{ empty($item->dateDone) ? '' : date('d.m.Y', strtotime($item->dateDone)) }}</x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center">
                                <x-button.icon-edit title="Редактировать"/>
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

    <x-modal-wire.dialog wire:model.defer="showCreate" maxWidth="md">
            <x-slot name="title"><span class="grow">Новая ЗНИ</span><x-button.icon-cancel @click="show = false" wire:click="cancelCreate" class="text-gray-700 hover:text-white" /></x-slot>
            <x-slot name="content">
                <form wire:submit.prevent="store" class="flex-col space-y-2">
                    <x-input.label>№ ЗНИ</x-input.label>
                    @error('newZNI') <div class="text-red-500">{{ $message }}</div> @enderror
                    <x-input.text wire:model.blur="newZNI" required />
                    <x-input.label>Название</x-input.label>
                    @error('newName') <div class="text-red-500">{{ $message }}</div> @enderror
                    <x-input.text wire:model.blur="newName" required />
                    <x-input.label>Инициатор</x-input.label>
                    @error('newInitiator') <div class="text-red-500">{{ $message }}</div> @enderror
                    <x-input.text wire:model.blur="newInitiator" list="initiators" required />
                    <datalist id="initiators">
                        @foreach ($initiators as $initiator)
                        <option>{{ $initiator->name }}</option>
                        @endforeach
                    </datalist>
                    <x-input.label>Описание</x-input.label>
                    @error('newContent') <div class="text-red-500">{{ $message }}</div> @enderror
                    <x-input.textarea wire:model.blur="newContent" required /> 
                    <x-input.label>Дата ЗНИ</x-input.label>
                    @error('newDateZNI') <div class="text-red-500">{{ $message }}</div> @enderror
                    <x-input.text type="date" wire:model.blur="newDateZNI" required />
                    <x-input.label>№ ДОИ</x-input.label>
                    @error('newDOI') <div class="text-red-500">{{ $message }}</div> @enderror
                    <x-input.text wire:model.blur="newDOI" />
                    <x-input.label>Дата ДОИ</x-input.label>
                    @error('newDateDOI') <div class="text-red-500">{{ $message }}</div> @enderror
                    <x-input.text type="date" wire:model.blur="newDateDOI" />

                    <x-button.create type="submit">Добавить</x-button.create>
                    <x-button.secondary @click="show = false" wire:click="cancelCreate">{{ __('Cancel') }}</x-button.secondary>
                </form>
            </x-slot>
    </x-modal-wire.dialog>

   <x-modal-wire.dialog wire:model.defer="showDelete" type="warn" maxWidth="md">
            <x-slot name="title"><span class="grow">Удалить ЗНИ</span><x-button.icon-cancel @click="show = false" wire:click="cancelDelete" class="text-gray-700 hover:text-white dark:hover:text-white" /></x-slot>
            <x-slot name="content">
                <div class="flex-col space-y-2">
                    <x-input.label class="text-lg font-medium">Вы действительно хотите удалить запись? 
                        <div class="text-black">{{ $item['zni'] ?? '' }}: {{ $item['name'] ?? '' }}. {{ $item['content'] ?? '' }}</div>
                    </x-input.label>
                    <x-button.secondary @click="show = false" wire:click="cancelDelete">Отменить</x-button.secondary>
                    <x-button.danger wire:click="destroy">{{ __('Delete')}}</x-button.danger>
                </div>                            
            </x-slot>
    </x-modal-wire.dialog>


</div>
