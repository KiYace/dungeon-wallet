<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IncomeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class IncomeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class IncomeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Income::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/income');
        CRUD::setEntityNameStrings('доход', 'доходы');
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
            'name' => 'player',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
        ]);
        $this->crud->addColumn([
            'name' => 'tags',
            'type' => 'relationship',
            'entity' => 'tags',
            'attribute' => 'name',
            'label' => 'Теги'
        ]);
        $this->crud->addColumn([
            'name' => 'category',
            'type' => 'relationship',
            'entity' => 'category',
            'attribute' => 'nickname',
            'label' => 'Категория'
        ]);
        $this->crud->addColumn([
            'name' => 'sum',
            'type' => 'number',
            'label' => 'Сумма'
        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(IncomeRequest::class);

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
            'name' => 'player',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
        ]);
        $this->crud->addField([
            'name' => 'tags',
            'type' => 'relationship',
            'entity' => 'tags',
            'attribute' => 'name',
            'label' => 'Теги'
        ]);
        $this->crud->addField([
            'name' => 'category',
            'type' => 'relationship',
            'entity' => 'category',
            'attribute' => 'nickname',
            'label' => 'Категория'
        ]);
        $this->crud->addField([
            'name' => 'sum',
            'type' => 'number',
            'label' => 'Сумма'
        ]);
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

    protected function setupSowOperation()
    {
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
            'name' => 'player',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
        ]);
        $this->crud->addColumn([
            'name' => 'tags',
            'type' => 'relationship',
            'entity' => 'tags',
            'attribute' => 'name',
            'label' => 'Теги'
        ]);
        $this->crud->addColumn([
            'name' => 'category',
            'type' => 'relationship',
            'entity' => 'category',
            'attribute' => 'nickname',
            'label' => 'Категория'
        ]);
        $this->crud->addColumn([
            'name' => 'sum',
            'type' => 'number',
            'label' => 'Сумма'
        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);
    }
}
