<?php

namespace App\Http\Requests\Admin\Auth;

use App\Models\Tenants\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password'  => ['required', 'string'],
        ];
    }
    public function authenticated()
    {

        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->email)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            $this->recordLoginAttempt();

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        if (!$user->hasRole('admin')) {
            $this->recordLoginAttempt();

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        Auth::guard('tenant')->login($user); // ✅ تسجيل الدخول الآمن بعد التحقق الكامل

        $this->clearRateLimit();
    }

    public function ensureIsNotRateLimited(): void
    {

        $key = $this->throttleKey();

        if (!RateLimiter::tooManyAttempts($key, 5)) {

            return;
        }

        throw ValidationException::withMessages(['email' =>
        __(__('auth.throttle'), [
            'seconds' => RateLimiter::availableIn($key),
        ]),]);
    }

    public function recordLoginAttempt(): void
    {
        RateLimiter::hit($this->throttleKey(), 60);
    }

    public function clearRateLimit(): void
    {
        RateLimiter::clear($this->throttleKey());
    }
    private function throttleKey(): String
    {

        return Str::lower($this->input('email')) . '|' . $this->ip();
    }
}
