<?php

namespace App\Http\Requests\RequestsDTO\Player;

use App\DTO\Player\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nickname' => 'required|min:4|max:15|unique:players',
            'mail' => 'required|email|unique:players',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
            'skin' => 'required|integer',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function getDto(): RegisterDTO
    {
        return new RegisterDTO(
            $this->get('nickname'),
            $this->get('mail'),
            $this->get('password'),
            $this->get('skin'),
            $this->get('push_enabled'),
            $this->get('push_token'),
        );
    }

    public function messages()
    {
        return [
            'nickname.unique' => 'Данный никнейм уже используется',
            'nickname.required' => 'Никнейм обязателен для заполнения',
            'nickname.min' => 'Никнейм должен содержаь более 4 символов',
            'nickname.max' => 'Никнейм должен содержаь менее 14 символов',
            'mail.unique' => 'Данный почтовый ящик уже используется',
            'mail.*' => 'Непрвильно заполнена почта',
            'password.min' => 'Пароль должен содержать более 6 символов',
            'password.*' => 'Пароль обязателен для заполнения',
            'password_confirm.*' => 'Пароли не совпадают',
            'skin.*' => 'Не выбран скин для персонажа',
        ];
    }
}
