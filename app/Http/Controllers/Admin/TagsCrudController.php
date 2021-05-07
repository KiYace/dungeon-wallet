<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Tags::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tags');
        CRUD::setEntityNameStrings('tags', 'tags');
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
            'name' => 'color',
            'type' => 'text',
            'label' => 'Цвет'
        ]);
        $this->crud->addColumn([
            'name' => 'player',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
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
            'label' => 'Дата изменения'
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
        CRUD::setValidation(TagsRequest::class);

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
            'name' => 'players',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
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
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название'
        ]);
        $this->crud->addColumn([
            'name' => 'color',
            'type' => 'text',
            'label' => 'Цвет'
        ]);
        $this->crud->addColumn([
            'name' => 'players',
            'type' => 'relationship',
            'entity' => 'player',
            'attribute' => 'nickname',
            'label' => 'Игрок'
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
            'label' => 'Дата изменения'
        ]);
    }
}
