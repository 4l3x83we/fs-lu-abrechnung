<div>
    <div class="w-96 flex space-x-2">
        <div class="flex flex-col w-full">
            <x-custom.forms.igr id="changeNote" :text="__('Notes')" wire:model.lazy="changeNote" class="mr-2" :icon="$charsCount"/>
        </div>
        <x-custom.button.button wire:click="store">{{ __('Change') }}</x-custom.button.button>
    </div>
</div>
