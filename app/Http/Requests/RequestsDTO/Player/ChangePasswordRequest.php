<?php

namespace App\Http\Requests\RequestsDTO\Player;

use App\DTO\Player\ChangeDTO;
use App\DTO\Player\ChangePasswordDTO;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password_old' => 'required|min:6',
            'password' => 'required|min:6|different:password_old',
            'password_confirm' => 'required|same:password'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function getDto(): ChangePasswordDTO
    {
        return new ChangePasswordDTO(
            $this->get('password_old'),
            $this->get('password'),
        );
    }

    public function messages()
    {
        return [
            'password_old.*' => 'Старый пароль введен не верно',
            'password.different' => 'Новый пароль не отличается от старого',
            'password.min' => 'Пароль должен содержать более 6 символов',
            'password.*' => 'Пароль обязателен для заполнения',
            'password_confirm.*' => 'Пароли не совпадают',
        ];
    }
}
