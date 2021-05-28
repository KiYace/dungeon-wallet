<?php

namespace App\Http\Requests\RequestsDTO\Tag;

use App\DTO\Tag\UpdateDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:4|max:15',
            'color' => 'required|min:6|max:6',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function getDto(): UpdateDTO
    {
        return new UpdateDTO(
            $this->get('name'),
            $this->get('color'),
        );
    }

    public function messages()
    {
        return [
            'name.*' => 'Поле название заполнено неверно',
            'color.*' => 'Цвет не выбран',
        ];
    }
}
