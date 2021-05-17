<?php

namespace App\Http\Requests\RequestsDTO;

use App\DTO\AuthDTO;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function getDto(): AuthDTO
    {
        return new AuthDTO(
            $this->get('email'),
            $this->get('password')
        );
    }
}
