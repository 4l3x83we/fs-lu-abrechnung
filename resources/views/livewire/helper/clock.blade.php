@php use Carbon\Carbon; @endphp

<div wire:poll.60000ms class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
    {{ Carbon::now()->format('d.m.Y H:i') }} Uhr
</div>
