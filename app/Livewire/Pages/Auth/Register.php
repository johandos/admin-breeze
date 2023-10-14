<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Register extends Component
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
    public array  $countries = [];

    public function mount(){
        $this->countries = [
            'US' => 'Estados Unidos',
            'ES' => 'España',
            'MX' => 'México',
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:20', 'not_regex:/\d/'],
            'surname' => ['required', 'string', 'min:2', 'max:40', 'not_regex:/\d/'],
            'dni' => ['required', 'unique:users,dni', 'regex:/^([0-9]{8}[A-Z]|[XYZ][0-9]{7}[A-Z])$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => 'nullable|regex:/^\+?[0-9]{9,12}$/',
            'country' => 'nullable|string',
            'iban' => 'required|regex:/^ES\d{2}\d{4}\d{4}\d{2}\d{10}$/',
            'about' => 'nullable|string|min:20|max:250',
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ];
    }


    public function register(): void
    {
        $validated = $this->validate();
        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        auth()->login($user);
        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.register')->layout('layouts.guest');
    }
}
