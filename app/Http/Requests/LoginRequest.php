<?php

namespace App\Http\Requests;

use App\Helpers\ExceptionHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ];
    }

    public function authenticate($attributes)
    {
        if (!auth()->attempt($attributes)) {
            ExceptionHelper::throwException(Response::HTTP_UNAUTHORIZED, 'Your email or password is incorrect.');
        }

        if (auth()->user()->email === 'admin@example.com') {
            $token = auth()->user()->createToken('User-Token')->plainTextToken;
        } else {
            $token = auth()->user()->createToken('User-Token', ['is-admin'])->plainTextToken;
        }

        return [
            'user' => auth()->user(),
            'token' => $token,
        ];
    }
}
