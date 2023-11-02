    <!-- Component Start -->
    @props([
        'days', 'eventDay'
    ])
    @php
        $rows = count($days)/7;
        $currentMonth = date('n', strtotime($eventDay));
        $currentDay = date('j', strtotime($eventDay));
        $toMonth = date('n');
        $toDay = date('j');
        $months = array( 1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' );

        $monthTxt = $months[$currentMonth];

    @endphp

    <div class="flex flex-grow overflow-auto text-xs"> 
            
            <div class="flex flex-col flex-grow">
                <div>{{ $monthTxt }}</div>
                <div class="grid flex-grow grid-cols-7 grid-rows-{{ $rows }} gap-px pt-px">
                    @foreach ($days as $day)
                        @php
                            $tab_month = date('n', strtotime($day['date']));
                            $tab_day = date('j', strtotime($day['date']));
                        @endphp
                        @if($tab_day == $currentDay && $tab_month == $currentMonth)
                            <span class="rounded-full text-xs  font-bold text-center bg-sky-300">
                                {{ $tab_day }}
                            </span>
                        @elseif ($tab_day == $toDay && $tab_month == $toMonth)
                            <span class="rounded-full text-xs text-center bg-amber-300">
                                {{ $tab_day }}
                            </span>
                        @elseif ($tab_month == $currentMonth)
                            <span class="rounded-full text-center text-xs bg-white">
                                {{ $tab_day }}
                            </span>
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
