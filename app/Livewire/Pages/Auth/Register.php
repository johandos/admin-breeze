<?php

namespace App\Livewire\Pages\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Country;
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

    public function mount(): void
    {
        $this->countries = Country::all()->pluck('name', 'code')->toArray();
    }

    public function rules(): array
    {
        $registerRequest = new RegisterRequest();
        return $registerRequest->rules();
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
