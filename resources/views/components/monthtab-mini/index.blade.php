    <!-- Component Start -->
    @props([
        'days', 'eventDay'
    ])
    @php
        $rows = count($days)/7;
        $currentMonth = date('n', strtotime($eventDay));
        $currentDay = date('j', strtotime($eventDay));
    @endphp

    <div class="flex flex-grow overflow-auto text-xs"> 
            
            <div class="flex flex-col flex-grow">
                <div class="grid flex-grow grid-cols-7 grid-rows-{{ $rows }} gap-px pt-px">
                    @foreach ($days as $day)
                        @php
                            $tab_month = date('n', strtotime($day['date']));
                            $tab_day = date('j', strtotime($day['date']));
                        @endphp
                        @if ($tab_month == $currentMonth)
                            @if($tab_day == $currentDay)
                            <span class="rounded-full text-xs  font-bold text-center bg-amber-300">
                                {{ $tab_day }}
                            </span>
                            @else
                            <span class="rounded-full text-xs text-center bg-white">
                                {{ $tab_day }}
                            </span>
                            @endif
                        @else
                            <span class="text-xs">
                                &nbsp;
                            </span>
                        @endif
                    @endforeach           
                </div>

            </div>
        </div>
    <!-- Component End  -->
