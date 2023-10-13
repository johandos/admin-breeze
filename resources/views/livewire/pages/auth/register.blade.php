<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $surname = '';
    public string $dni = '';
    public string $email = '';
    public string $phone = '';
    public string $country = '';
    public string $iban = '';
    public string $about = '';
    public string $password = '';
    public string $password_confirmation = '';
    public array  $countries = [
        'US' => 'Estados Unidos',
        'ES' => 'España',
        'MX' => 'México',
            // ... más países
        ];

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:20', 'not_regex:/\d/'],
            'surname' => ['required', 'string', 'min:2', 'max:40', 'not_regex:/\d/'],
            'dni' => ['required', 'regex:/^[0-9]{8}[A-Z]$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => 'nullable|regex:/^\+?[0-9]{9,12}$/',
            'country' => 'nullable|string',
            'iban' => 'required|regex:/^ES\d{2}\d{4}\d{4}\d{2}\d{10}$/',
            'about' => 'nullable|string|min:20|max:250',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $validated['surname'] = $this->surname;
        $validated['dni'] = $this->dni;

        event(new Registered($user = User::create($validated)));

        auth()->login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div class="mt-4">
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input wire:model="surname" id="surname" class="block mt-1 w-full" type="text" name="surname" required />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- DNI -->
        <div class="mt-4">
            <x-input-label for="dni" :value="__('DNI')" />
            <x-text-input wire:model="dni" id="dni" class="block mt-1 w-full" type="text" name="dni" required />
            <x-input-error :messages="$errors->get('dni')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" name="phone" autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- País -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <select wire:model="country" id="country" name="country" class="block mt-1 w-full">
                <option value="" disabled selected>Selecciona un país</option>
                @foreach ($countries as $code => $name)
                    <option value="{{ $code }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- IBAN -->
        <div class="mt-4">
            <x-input-label for="iban" :value="__('IBAN')" />
            <x-text-input wire:model="iban" id="iban" class="block mt-1 w-full" type="text" name="iban" required autocomplete="iban" />
            <x-input-error :messages="$errors->get('iban')" class="mt-2" />
        </div>

        <!-- Sobre ti -->
        <div class="mt-4">
            <x-input-label for="about" :value="__('About You')" />
            <textarea wire:model="about" id="about" class="block mt-1 w-full" name="about"></textarea>
            <x-input-error :messages="$errors->get('about')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
