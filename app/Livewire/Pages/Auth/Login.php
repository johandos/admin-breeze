<?php

namespace App\Livewire\Pages\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function mount(): void
    {
    }

    public function rules(): array
    {
        $loginRequest = new LoginRequest();
        return $loginRequest->rules();
    }

    /**
     * @throws ValidationException
     */
    public function login(): void
    {
        $this->validate();
        $loginRequest = new LoginRequest();

        $loginRequest->ensureIsNotRateLimited();

        if (! auth()->attempt($this->only(['email', 'password'], $this->remember))) {
            RateLimiter::hit($loginRequest->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('validation.failed'),
            ]);
        }

        RateLimiter::clear($loginRequest->throttleKey());

        session()->regenerate();

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
