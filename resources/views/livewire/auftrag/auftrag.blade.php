<div>
    <form wire:submit.prevent="store" method="POST" class="p-4">
        <div class="grid grid-cols-1 xl:grid-cols-3 pb-0 gap-4">
            {{-- Oben --}}
            <div class="col-span-3">
                <x-custom.card.head class="!mb-0 h-full">
                    <div class="flex justify-between items-center">
                        <div class="">
                            <span class="font-bold mr-1">{{ __('Current map') }}:</span> {{ auth()->user()->mapAuswahl()['maps'] }}
                        </div>
                        <div class="">
                            <span class="font-bold mr-1">{{ __('Fields') }}:</span> {{ auth()->user()->mapAuswahl()['fields'] }}
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
            {{-- Left --}}
            <div class="col-span-3 xl:col-span-1">
                <x-custom.card.head class="!mb-0 h-full">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Feld- / Wiesenauftrag</h3>
                    <div class="grid gap-6 mb-6 xl:grid-cols-2">
                        <div class="col-span-2">
                            <div class="flex">
                                <x-custom.forms.checkbox-radio type="radio" id="feld_auftrag" wire:model="auftrag.auftragsart" :text="__('Field Order')" value="1"/>
                                <x-custom.forms.checkbox-radio type="radio" id="wiesen_auftrag" wire:model="auftrag.auftragsart" :text="__('Meadow Order')" value="0"/>
                            </div>
                            <div class="mt-4">
                                <div class="grid gap-4 grid-cols-2">
                                    <div class="col-span-1">
                                        <x-custom.forms.small-form-with-label id="fieldNr" wire:model="fieldNr" text="{{ __('Field Number') }}"/>
                                    </div>
                                    <div class="col-span-1">
                                        <x-custom.forms.igr id="fields" wire:model="fields" text="Hektar" icon="ha"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <x-custom.forms.select-form-with-label id="auftrag.feldauftrag" wire:model="auftrag.feldauftrag" text="">
                                    <option value="">{{ __('Choose an order') }}</option>
                                    @foreach($auftragsType as $type)
                                        @if($type->type === 'Auftrag')
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endif
                                    @endforeach
                                </x-custom.forms.select-form-with-label>
                            </div>
                            <div class="mt-4">
                                <x-custom.forms.checkbox-radio id="eigeneMaschinen" wire:model="eigeneMaschinen" :text="__('Use your own machines')" value="true"/>
                            </div>
                            <div class="mt-4">
                                <div class="grid gap-4 grid-cols-2">
                                    <div class="{{ (empty($eigeneMaschinen) ? 'col-span-2' : 'col-span-1' ) }}">
                                        <x-custom.forms.small-form-with-label id="auftrag.kosten_pro_auftrag" wire:model="auftrag.kosten_pro_auftrag" text="{{ __('cost of order') }}"/>
                                    </div>
                                    @if(!empty($eigeneMaschinen))
                                    <div class="col-span-1">
                                        <x-custom.forms.small-form-with-label id="auftrag.kosten_fuer_maschinen" wire:model="auftrag.kosten_fuer_maschinen" text="{{ __('machine costs') }}"/>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
            {{-- Mitte --}}
            <div class="col-span-3 xl:col-span-1">
                <x-custom.card.head class="!mb-0 h-full">

                </x-custom.card.head>
            </div>
            {{-- Rechts --}}
            <div class="col-span-3 xl:col-span-1">
                <x-custom.card.head class="!mb-0 h-full">

                </x-custom.card.head>
            </div>
        </div>
    </form>
</div>
