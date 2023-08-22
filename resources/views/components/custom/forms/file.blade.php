@error($id ?? '')
<label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-50">{{ $text ?? '' }}@if($stern ?? false) <span class="text-white">*</span>@endif</label>
    <input type="file" value="{{ old($id ?? '') }}" id="{{ $id ?? '' }}" name="{{ $id ?? '' }}" {{ $attributes->merge(['class' => 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-xs rounded focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-600 dark:placeholder-red-500 dark:border-red-500']) }}>
    <span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $text ?? '' }}@if($stern ?? false) <span class="text-red-500">*</span>@endif</label>
    <input type="file" id="{{ $id ?? '' }}" name="{{ $id ?? '' }}" placeholder="{{ $text ?? '' }}" {{ $attributes->merge(['class' => 'block w-full text-xs text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400']) }}>
@enderror
