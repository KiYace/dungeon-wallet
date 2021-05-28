<?php

namespace App\Http\Requests\RequestsDTO\Player;

use App\DTO\Player\ChangeDTO;
use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nickname' => 'required|min:4|max:15|unique:players',
            'skin' => 'required|integer|exists:skins,id',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function getDto(): ChangeDTO
    {
        return new ChangeDTO(
            $this->get('nickname'),
            $this->get('skin'),
        );
    }

    public function messages()
    {
        return [
            'nickname.unique' => 'Данный никнейм уже используется',
            'nickname.required' => 'Никнейм обязателен для заполнения',
            'nickname.min' => 'Никнейм должен содержаь более 4 символов',
            'nickname.max' => 'Никнейм должен содержаь менее 14 символов',
            'skin.required' => 'Не выбран скин для персонажа',
            'skin.exists' => 'Данный скин персонажа недоступен',
        ];
    }
}
