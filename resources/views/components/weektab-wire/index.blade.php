    <!-- Component Start -->
    @props([
        'week'=>'-',
        'year'=>'-',
        'start'=>'-',
        'end'=>'-'
    ])

    <div class="flex flex-grow w-full h-full overflow-auto"> 
            
            <div class="flex flex-col flex-grow">
                <div class="grid grid-cols-12 items-center">
                    @isset($buttons)
                       {{$buttons}}
                    @endisset
                    <h2 class="col-span-4 ml-2 text-xl font-bold leading-none">
                        {{ __('Week') }} {{ $week }}. {{ $start }} - {{ $end }} {{ $year }}
                    </h2>
                    @isset($navigation)
                        {{ $navigation }}
                    @endisset      
                </div>

                {{ $slot }}

            </div>
        </div>
    <!-- Component End  -->
