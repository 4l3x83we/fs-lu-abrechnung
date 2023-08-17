<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="{{ $id ?? '' }}" data-tabs-toggle="#{{ $id ?? '' }}Content" role="tablist">
        {{ $slot ?? ''  }}
    </ul>
</div>


