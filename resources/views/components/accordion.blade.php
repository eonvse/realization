<div x-data="{ openedIndex: -1 }" class="flex flex-col">
  <div @click="openedIndex == 1 ? openedIndex = -1 : openedIndex = 1" class="grid grid-cols-3 bg-gray-100 dark:bg-gray-700 border p-2 dark:border-gray-600 hover:bg-indigo-100 hover:dark:bg-gray-500 text-gray-500 dark:text-gray-300 hover:text-black hover:dark:text-white">
    <div>{{ $header }}</div>
    <span class="justify-self-start flex">{{ $action ?? '' }}</span>
    <span x-text="openedIndex == 1 ? '&#9650;' : '&#9660;'" class="justify-self-end text-gray-400"></span>
  </div>
  <div x-show.transition.in.duration.800ms="openedIndex == 1" class="border dark:border-gray-600 p-4">
    {{ $content }}
  </div>
</div>