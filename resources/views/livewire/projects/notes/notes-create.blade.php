<div>
    @if($newNotes === false)
        <x-custom.button.button wire:click="newNotes" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded px-3 py-2 text-xs dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 duration-300">
            <svg class="w-3 h-3 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            {{ __('Add new Notes') }}
        </x-custom.button.button>
    @else
        <div class="w-96 flex space-x-2">
            <div class="flex flex-col w-full">
                <x-custom.forms.igr id="notes" :text="__('Notes')" wire:model.lazy="notes" class="mr-2" :icon="$charsCount"/>
            </div>
            <x-custom.button.button wire:click="store">{{ __('Save') }}</x-custom.button.button>
        </div>
    @endif
</div>
