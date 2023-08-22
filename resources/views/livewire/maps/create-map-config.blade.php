<div>
    <x-custom.main.head>
        <form wire:submit.prevent="store" method="POST">
            <div class="grid grid-cols-1 xl:grid-cols-2 pb-0 gap-4">
                {{-- Left --}}
                <div class="col-span-1">
                    <x-custom.card.head class="!mb-0 h-full">
                        <div class="grid grid-cols-1 xl:grid-cols-2 pb-0 gap-4">
                            <div class="col-span-1">
                                <x-custom.forms.switch id="maps.md_public_private" :text="__('Private Map') .' / '. __('Configurations Changed')" />
                            </div>
                            <div class="col-span-1">
                                <x-custom.forms.switch id="maps.md_sprayTypes_available" :text="__('Original sprayTypesXML')"/>
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-custom.forms.file id="maps.modDesc" text="modDesc.xml {{ __('Import') }}" wire:model="maps.modDesc" stern="true"/>
                        </div>
                        <div class="mt-4">
                            <x-custom.forms.file id="maps.fillType" text="fillTypes.xml {{ __('Import') }}" wire:model="maps.fillType" stern="true"/>
                        </div>
                        <div class="mt-4">
                            <x-custom.forms.file id="maps.fruitType" text="fruitTypes.xml {{ __('Import') }}" wire:model="maps.fruitType" stern="true"/>
                        </div>
                    </x-custom.card.head>
                </div>
                {{-- Right --}}
                <div class="col-span-1">
                    <x-custom.card.head class="!mb-0 h-full">
                        <div class="mt-4">
                            <x-custom.forms.file id="maps.farmland" text="farmlands.xml {{ __('Import') }}" wire:model="maps.farmland" stern="true"/>
                        </div>
                        <div class="mt-4">
                            @if($sprayTypes)
                                <x-custom.forms.file id="maps.sprayType" text="sprayTypes.xml {{ __('Import') }}" wire:model="maps.sprayType" stern="true"/>
                            @endif
                        </div>
                        <div class="mt-4">
                            <x-custom.forms.file id="maps.fields" text="fields.txt {{ __('Import') }} ({{ __('Generate field sizes from Map.i3d and save as .txt file') }})" wire:model="maps.fields" stern="true"/>
                        </div>
                        <div class="flex justify-end mt-4">
                            @if($submit)
                                <x-custom.button.button type="submit" class="disabled:opacity-50">{{ __('Save') }}</x-custom.button.button>
                            @else
                                <x-custom.button.button type="submit" class="disabled:opacity-50" disabled wire:loading.remove>{{ __('Save') }}</x-custom.button.button>
                            @endif
                        </div>
                    </x-custom.card.head>
                </div>
            </div>
        </form>
    </x-custom.main.head>
</div>
