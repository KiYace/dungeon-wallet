<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GoalRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GoalCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GoalCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Goal::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/goal');
        CRUD::setEntityNameStrings('goal', 'goals');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'id',
            'type' => 'number',
            'label' => 'ID'
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название'
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Описание'
        ]);
        $this->crud->addColumn([
            'name' => 'important',
            'type' => 'select_from_array',
            'options' => [
                'easy' => 'Маленькая',
                'medium' => 'Средняя',
                'high' => 'Высокая'
            ],
            'label' => 'Важность'
        ]);
        $this->crud->addColumn([
            'name' => 'player',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
        ]);
        $this->crud->addColumn([
            'name' => 'target',
            'type' => 'number',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'current',
            'type' => 'number',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'remind_at',
            'type' => 'select_from_array',
            'options' => [
                'day' => 'Каждый день',
                'week' => 'Каждую неделю',
                'month' => 'Каждый месяц',
                'not' => 'Не напоминать',
            ],
            'label' => 'Напоминание'
        ]);
        $this->crud->addColumn([
            'name' => 'favorite',
            'type' => 'checkbox',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'reached',
            'type' => 'checkbox',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GoalRequest::class);
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название'
        ]);
        $this->crud->addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Описание'
        ]);
        $this->crud->addField([
            'name' => 'important',
            'type' => 'select_from_array',
            'options' => [
                'easy' => 'Маленькая',
                'medium' => 'Средняя',
                'high' => 'Высокая'
            ],
            'label' => 'Важность'
        ]);
        $this->crud->addField([
            'name' => 'player',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
        ]);
        $this->crud->addField([
            'name' => 'target',
            'type' => 'number',
            'label' => 'Цель'
        ]);
        $this->crud->addField([
            'name' => 'current',
            'type' => 'number',
            'label' => 'Цель'
        ]);
        $this->crud->addField([
            'name' => 'remind_at',
            'type' => 'select_from_array',
            'options' => [
                'day' => 'Каждый день',
                'week' => 'Каждую неделю',
                'month' => 'Каждый месяц',
                'not' => 'Не напоминать',
            ],
            'label' => 'Напоминание'
        ]);
        $this->crud->addField([
            'name' => 'favorite',
            'type' => 'checkbox',
            'label' => 'Цель'
        ]);
        $this->crud->addField([
            'name' => 'reached',
            'type' => 'checkbox',
            'label' => 'Цель'
        ]);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'id',
            'type' => 'number',
            'label' => 'ID'
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название'
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Описание'
        ]);
        $this->crud->addColumn([
            'name' => 'important',
            'type' => 'select_from_array',
            'options' => [
                'easy' => 'Маленькая',
                'medium' => 'Средняя',
                'high' => 'Высокая'
            ],
            'label' => 'Важность'
        ]);
        $this->crud->addColumn([
            'name' => 'player',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
        ]);
        $this->crud->addColumn([
            'name' => 'target',
            'type' => 'number',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'current',
            'type' => 'number',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'remind_at',
            'type' => 'select_from_array',
            'options' => [
                'day' => 'Каждый день',
                'week' => 'Каждую неделю',
                'month' => 'Каждый месяц',
                'not' => 'Не напоминать',
            ],
            'label' => 'Напоминание'
        ]);
        $this->crud->addColumn([
            'name' => 'favorite',
            'type' => 'checkbox',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'reached',
            'type' => 'checkbox',
            'label' => 'Цель'
        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);
    }
}
