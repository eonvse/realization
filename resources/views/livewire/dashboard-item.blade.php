<div>
    @include('layouts.navigation')

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-2 space-x-5 p-4">
                    <div>@include('livewire.part.item-info')</div>
                    <div>@include('livewire.part.item-files')</div>
                </div>

            </div>
        </div>
    </div>
</div>
