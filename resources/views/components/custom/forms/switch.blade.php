<label class="relative inline-flex items-center cursor-pointer">
    <input type="checkbox" id="{{ $id ?? '' }}" name="{{ $id ?? '' }}" wire:model="{{ $id ?? '' }}" class="sr-only peer" value="{{ $value ?? true }}" {{ $checked ?? '' }}>
    <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $text ?? '' }}</span>
</label>
