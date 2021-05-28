<?php

namespace App\Http\Requests\RequestsDTO\Expense;

use App\DTO\Expense\CreateDTO;
use App\Models\Expense;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:4|max:15',
            'description' => 'max:255',
            'category_id' => 'required|exists:categories,id',
            'repeat_at' => Rule::in(array_keys(Expense::getExpensesRepeatTypeList())),
            'sum' => 'required|integer'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function getDto(): CreateDTO
    {
        return new CreateDTO(
            $this->get('name'),
            $this->get('description'),
            $this->get('category_id'),
            $this->get('repeat_at'),
            $this->get('sum'),
        );
    }

    public function messages()
    {
        return [
            'name.*' => 'Поле название заполнено неверно',
            'category_id.required' => 'Выберите категорию расхода',
            'category_id.exists' => 'Выбранной категории не существует :)',
            'repeat_at.*' => 'Вебрите время повтора для расхода',
            'sum.*' => 'Укажите сумму расхода',
        ];
    }
}
