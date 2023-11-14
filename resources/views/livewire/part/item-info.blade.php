<x-head.h2>Заявка на изменение</x-head.h2>
<div class="grid grid-cols-2 items-center">
	<div>
		<x-input.label>№ ЗНИ</x-input.label>
		<div class="font-bold text-lg">{{ $model->zni }}</div>
	</div>	
	<div>
		@if (!$model->isDone)
			<x-button.secondary wire:click="executed">Выполнено</x-button.secondary>
		@else
			<div class="font-bold text-indigo-700">Выполнено {{ date('d.m.Y', strtotime($model->dateDone)) }}</div>
		@endif
	</div>
</div>
<form wire:submit.prevent="store">
	<x-input.label class="mt-3">Название</x-input.label>
	@error('modelName') <div class="text-red-500">{{ $message }}</div> @enderror
	<x-input.text wire:model.live="modelName" required :disabled="!$showEdit" />
	<x-input.label class="mt-3">Инициатор</x-input.label>
	@error('modelInitiator') <div class="text-red-500">{{ $message }}</div> @enderror
	<x-input.text wire:model.live="modelInitiator" list="initiators" required :disabled="!$showEdit" />
	<datalist id="initiators">
	    @foreach ($initiators as $initiator)
	    <option>{{ $initiator->name }}</option>
	    @endforeach
	</datalist>
	<x-input.label class="mt-3">Дата ЗНИ</x-input.label>
	@error('modelDateZNI') <div class="text-red-500">{{ $message }}</div> @enderror
	<x-input.text type="date" wire:model.live="modelDateZNI" required :disabled="!$showEdit" />
	<x-input.label class="mt-3">№ ДОИ</x-input.label>
	@error('modelDOI') <div class="text-red-500">{{ $message }}</div> @enderror
	<x-input.text wire:model.live="modelDOI" :disabled="!$showEdit" />
	<x-input.label class="mt-3">Дата ДОИ</x-input.label>
	@error('modelDateDOI') <div class="text-red-500">{{ $message }}</div> @enderror
	@if ($showEdit)
	<x-input.text type="date" wire:model.live="modelDateDOI" :disabled="!$showEdit" />
	@else
	<div class="font-bold border p-1 rounded">{{ empty($modelDateDOI) ? '' : date('d.m.Y', strtotime($modelDateDOI)) }}</div>
	@endif
	@if ($showEdit)
	<x-button.create type="submit" class="mt-3">Сохранить</x-button.create>
	<x-button.secondary wire:click="cancelEdit">{{ __('Cancel') }}</x-button.secondary>
	@else
	<x-button.create class="mt-3" wire:click="editItem">Редактировать</x-button.create>
	@endif
</form>
