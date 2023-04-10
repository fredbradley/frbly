<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bitlinks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Create Bitlinks
                    </div>

                    <x-form-section submit="createBitlink">
                        <x-slot name="title">
                            {{ __('Create Bitlink') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Create your bitlink.') }}
                        </x-slot>

                        <x-slot name="form">
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="long_url" value="{{ __('Long URL') }}" />
                                <x-input id="long_url" type="url" class="mt-1 block w-full" wire:model.defer="state.long_url" autocomplete="long_url" />
                                <x-input-error for="long_url" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="domain" value="{{ __('Domain') }}" />
                                <select name="domain" id="domain" wire:model.defer="state.domain" class="mt-1 block w-full">
                                    <option value="bit.ly">bit.ly</option>
                                    <option value="cran.ly">cran.ly</option>
                                </select>
                            </div>
                        </x-slot>

                        <x-slot name="actions">

                            <x-button>
                                {{ __('Save') }}
                            </x-button>
                        </x-slot>
                    </x-form-section>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
