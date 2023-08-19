@error($id ?? '')
<label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500 hidden">{{ $text ?? '' }}</label>
<input type="{{ $type ?? 'text' }}" id="{{ $id ?? '' }}" name="{{ $id ?? '' }}" placeholder="{{ $text ?? '' }}" {{ $attributes->merge(['class' => 'block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
    <span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white hidden">{{ $text ?? '' }}</label>
    <input type="{{ $type ?? 'text' }}" id="{{ $id ?? '' }}" name="{{ $id ?? '' }}" placeholder="{{ $text ?? '' }}" {{ $attributes->merge(['class' => 'block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
@enderror
