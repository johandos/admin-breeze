
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Product') }}
    </h2>
</x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form wire:submit.prevent="save">
                    <div class="text-gray-900 dark:text-gray-100">
                        <h1>Creación de productos</h1>
                    </div>


                    @if (session()->has('message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="block mt-4">
                        <!-- Campo de Nombre -->
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <!-- Campo de Referencia -->
                        <x-input-label for="reference" :value="__('Referencia')" />
                        <x-text-input wire:model="reference" id="reference" class="block mt-1 w-full" type="text" name="reference" required />
                        <x-input-error :messages="$errors->get('reference')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <!-- Campo de Descripción -->
                        <x-input-label for="description" :value="__('Descripción')" />
                        <textarea wire:model="description" id="description" class="block mt-1 w-full" name="description"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <x-primary-button class="my-3">
                            {{ __('Crear producto') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
