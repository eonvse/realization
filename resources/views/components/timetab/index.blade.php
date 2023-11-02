    <!-- Component Start -->
    @props([
        'month'=>'-',
        'year'=>'-'
    ])

    <div class="flex flex-grow w-screen h-screen overflow-auto"> 
            
            <div class="flex flex-col flex-grow">
                <div class="flex items-center mt-4">
                    @isset($buttons)
                       {{$buttons}}
                    @endisset   
                    <h2 class="ml-2 text-xl font-bold leading-none">{{ $month }}, {{ $year }}</h2>
                </div>
                <div class="grid grid-cols-7 mt-4 text-sm font-bold">
                    <div class="pl-1">{{ __('Mon') }}</div>
                    <div class="pl-1">{{ __('Tue') }}</div>
                    <div class="pl-1">{{ __('Wed') }}</div>
                    <div class="pl-1">{{ __('Thu') }}</div>
                    <div class="pl-1">{{ __('Fri') }}</div>
                    <div class="pl-1">{{ __('Sat') }}</div>
                    <div class="pl-1">{{ __('Sun') }}</div>
                </div>

                {{ $slot }}

            </div>
        </div>
    <!-- Component End  -->
