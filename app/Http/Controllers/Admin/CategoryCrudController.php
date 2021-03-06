<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('категория', 'категории');
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
            'name' => 'color',
            'type' => 'color',
            'label' => 'Цвет'
        ]);
        $this->crud->addColumn([
            'name' => 'player',
            'type' => 'relationship',
            'label' => 'Игрок',
            'entity' => 'player',
            'attribute' => 'nickname'
        ]);
        $this->crud->addColumn([
            'name' => 'system',
            'type' => 'check',
            'label' => 'Системный'
        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'type' => 'date',
            'label' => 'Дата удаления'
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
        CRUD::setValidation(CategoryRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название'
        ]);
        $this->crud->addField([
            'name' => 'color',
            'type' => 'color',
            'label' => 'Цвет'
        ]);
        $this->crud->addField([
            'name' => 'player',
            'type' => 'relationship',
            'label' => 'Игрок',
            'entity' => 'player',
            'attribute' => 'nickname'
        ]);
        $this->crud->addField([
            'name' => 'system',
            'type' => 'checkbox',
            'label' => 'Системный'
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

    protected function setupShowOperation()
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
            'name' => 'color',
            'type' => 'color',
            'label' => 'Цвет'
        ]);
        $this->crud->addColumn([
            'name' => 'player',
            'type' => 'relationship',
            'label' => 'Игрок',
            'entity' => 'player',
            'attribute' => 'nickname'
        ]);
        $this->crud->addColumn([
            'name' => 'system',
            'type' => 'check',
            'label' => 'Системный'
        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'date',
            'label' => 'Дата создания'
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'type' => 'date',
            'label' => 'Дата удаления'
        ]);
    }
}
