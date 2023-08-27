<div>
    <form wire:submit.prevent="store" method="POST" class="p-4">
        <div class="grid grid-cols-1 xl:grid-cols-3 pb-0 gap-4">
            {{-- Oben --}}
            <div class="col-span-3">
                <x-custom.card.head class="!mb-0 h-full">
                    <div class="flex justify-between items-start xl:items-center flex-col xl:flex-row">
                        <div class="">
                            <span class="font-bold mr-1">{{ __('Current map') }}:</span> {{ auth()->user()->mapAuswahl()['maps'] }}
                        </div>
                        <div class="">
                            <span class="font-bold mr-1">{{ __('Fields') }}:</span> {{ auth()->user()->mapAuswahl()['fields'] }}
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
            {{-- Fields --}}
            <div class="col-span-3">
                <x-custom.card.head class="!mb-0 h-full">
                    <div class="flex flex-col justify-start xl:flex-row xl:justify-between">
                        <div class="flex w-full xl:w-1/2 flex-col xl:flex-row">
                            <x-custom.forms.checkbox-radio type="radio" id="feld_auftrag" wire:model="auftrag.auftragsart" :text="__('Field Order')" value="1"/>
                            <x-custom.forms.checkbox-radio type="radio" id="wiesen_auftrag" wire:model="auftrag.auftragsart" :text="__('Meadow Order')" value="0"/>
                            <x-custom.forms.checkbox-radio id="changeSwitchHa" wire:model="changeSwitchHa" :text="__('Own field size')" value="1"/>
                        </div>
                        <div class="mt-4 xl:mt-0 w-full xl:w-1/2">
                            <div class="grid gap-4 grid-cols-2">
                                <div class="col-span-1">
                                    <x-custom.forms.small-form-inline-label id="auftrag.fieldNr" wire:model="auftrag.fieldNr" text="{{ __('Field Number') }}"/>
                                </div>
                                <div class="col-span-1">
                                    @if($switchHa === false)
                                        <x-custom.forms.inline-igr id="auftrag.ha" wire:model="auftrag.ha" text="Hektar" icon="ha" readonly/>
                                    @else
                                        <x-custom.forms.inline-igr id="auftrag.changeHA" wire:model="auftrag.changeHA" text="Hektar" class="!border-primary-300 !dark:border-primary-600" icon="ha" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
            {{-- Left --}}
            <div class="col-span-3 xl:col-span-1">
                <x-custom.card.head class="!mb-0 h-full">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Feld- / Wiesenauftrag</h3>
                    <div class="grid gap-4 xl:grid-cols-2">
                        <div class="col-span-2">
                            <div class="mt-0">
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
                                <x-custom.forms.checkbox-radio id="auftrag.eigeneMaschinen" wire:model="auftrag.eigeneMaschinen" :text="__('Use your own machines')" value="true"/>
                            </div>
                            <div class="mt-4">
                                <div class="grid gap-4 grid-cols-2">
                                    <div class="col-span-2 {{ (empty($auftrag['eigeneMaschinen']) ? 'sm:col-span-2' : 'sm:col-span-1' ) }}">
                                        <x-custom.forms.small-form-with-label class="text-center" id="auftrag.kosten_pro_auftrag" wire:model="auftrag.kosten_pro_auftrag" text="{{ __('cost of order') }}" readonly/>
                                    </div>
                                    @if(!empty($auftrag['eigeneMaschinen']))
                                    <div class="col-span-2 sm:col-span-1">
                                        <x-custom.forms.small-form-with-label class="text-center" id="auftrag.kosten_fuer_maschinen" wire:model="auftrag.kosten_fuer_maschinen" text="{{ __('machine costs') }}" readonly/>
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
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">mit Dünger- / Pflanzenschutzmittel</h3>
                    <div class="grid gap-4 xl:grid-cols-2">
                        <div class="col-span-2">
                            <div>
                                <x-custom.forms.select-form-with-label id="duenger.duengerChange" wire:model="duenger.duengerChange" text="">
                                    <option value="" class="text-center">-</option>
                                    @foreach(fertilizer() as $type)
                                        <option value="{{ $type['name'] }}">{{ __('fillTypes.'.$type['name']) }}</option>
                                    @endforeach
                                </x-custom.forms.select-form-with-label>
                            </div>
                            @if($duengerChangeMonth)
                                <div class="mt-4">
                                    <x-custom.forms.select-form-with-label id="duenger.monthDuenger" wire:model="duenger.monthDuenger" text="">
                                        <option value="">{{ __('Choose a month') }}</option>
                                        @foreach(months()['shortNum'] as $index => $type)
                                            <option value="{{ $index }}">{{ __('months.'.$type) }}</option>
                                        @endforeach
                                    </x-custom.forms.select-form-with-label>
                                </div>
                            @endif
                            <div class="mt-4">
                                <x-custom.forms.inline-igr class="text-right" id="duenger.litersPerSecond" wire:model="duenger.litersPerSecond" :text="__('spread rate')" icon="L" readonly/>
                            </div>
                            <div class="mt-4">
                                <x-custom.forms.small-form-inline-label class="text-center" id="duenger.kostenDuenger" wire:model="duenger.kostenDuenger" :text="__('Cost')" readonly/>
                            </div>
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
            {{-- Rechts --}}
            <div class="col-span-3 xl:col-span-1">
                <x-custom.card.head class="!mb-0 h-full">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">mit Saatgut</h3>
                    <div class="grid gap-4 xl:grid-cols-2">
                        <div class="col-span-2">
                            <div>
                                <x-custom.forms.select-form-with-label id="saatgut.saatgutChange" wire:model="saatgut.saatgutChange" text="">
                                    <option value="" class="text-center">-</option>
                                    @foreach(saatgut() as $type)
                                        <option value="{{ $type['name'] }}">{{ __('fillTypes.'.strtoupper($type['name'])) }}</option>
                                    @endforeach
                                </x-custom.forms.select-form-with-label>
                            </div>
                            <div class="mt-4">
                                <x-custom.forms.select-form-with-label id="saatgut.monthSaatgut" wire:model="saatgut.monthSaatgut" text="">
                                    <option value="">{{ __('Choose a month') }}</option>
                                    @foreach(months()['shortNum'] as $index => $type)
                                        <option value="{{ $index }}">{{ __('months.'.$type) }}</option>
                                    @endforeach
                                </x-custom.forms.select-form-with-label>
                            </div>
                            <div class="mt-4">
                                <x-custom.forms.inline-igr class="text-right" id="saatgut.seedUsagePerSqm" wire:model="saatgut.seedUsagePerSqm" :text="__('spread rate')" icon="L" readonly/>
                            </div>
                            <div class="mt-4">
                                <x-custom.forms.small-form-inline-label class="text-center" id="saatgut.kostenSaatgut" wire:model="saatgut.kostenSaatgut" :text="__('Cost')" readonly/>
                            </div>
                        </div>
                    </div>
                </x-custom.card.head>
            </div>

            {{-- Kostenübersicht --}}
            <div class="col-span-3">
                <x-custom.card.head class="!mb-0 h-full">
                    <div class="flex justify-between items-start xl:items-center flex-col xl:flex-row">
                        <div class="">
                            <span class="font-bold mr-1">{{ __('Cost Overview') }}</span>
                        </div>
                        <div class="my-4 xl:my-0">
                            <div class="flex flex-col xl:flex-row xl:space-x-4 space-y-2 xl:space-y-0">
                                <div><span class="font-bold">{{ __('Order') }}:</span> <span class="text-green-500">{{ numberFormat($costOverview['order']) }}</span></div>
                                @if($costOverview['machinery'] > 0)
                                    <div><span class="font-bold">{{ __('plus') . ' ' . __('Machinery') }}:</span> <span class="text-green-500">{{ numberFormat($costOverview['machinery']) }}</span></div>
                                @endif
                                @if($costOverview['fertilizer'] > 0)
                                    <div><span class="font-bold">{{ __('plus') . ' ' . __('Fertilizer') }}:</span> <span class="text-green-500">{{ numberFormat($costOverview['fertilizer']) }}</span></div>
                                @endif
                                @if($costOverview['seed'] > 0)
                                    <div><span class="font-bold">{{ __('plus') . ' ' . __('Seed') }}:</span> <span class="text-green-500">{{ numberFormat($costOverview['seed']) }}</span></div>
                                @endif
                            </div>
                        </div>
                        <div class="">
                            <div class="flex xl:items-center flex-col xl:flex-row xl:space-x-4 space-y-2 xl:space-y-0">
                                <div><span class="font-bold mr-1">{{ __('Total') }}:</span> <span class="text-red-500">{{ numberFormat($costOverview['total']) }}</span></div>
                                @if(auth()->check())
                                    <div class="mt-4">
                                        <x-custom.button.button wire:click="store()">{{ __('Save') }}</x-custom.button.button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </x-custom.card.head>
            </div>
        </div>
    </form>
</div>
