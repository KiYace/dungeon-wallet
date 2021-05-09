<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BossRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BossCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BossCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Boss::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/boss');
        CRUD::setEntityNameStrings('босс', 'боссы');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
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
            'name' => 'difficulty',
            'type' => 'select_from_array',
            'options' => [
                'easy' => 'Легкая',
                'medium' => 'Средняя',
                'high' => 'Высокая'
            ],
            'label' => 'Название'
        ]);
        $this->crud->addColumn([
            'name' => 'rating',
            'type' => 'number',
            'label' => 'Рейтинг'
        ]);
        $this->crud->addColumn([
            'name' => 'skin',
            'type' => 'image',
            'label' => 'Скин'
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
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BossRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Название'
        ]);
        $this->crud->addField([
            'name' => 'difficulty',
            'type' => 'select_from_array',
            'options' => [
                'easy' => 'Легкая',
                'medium' => 'Средняя',
                'high' => 'Высокая'
            ],
            'label' => 'Название'
        ]);
        $this->crud->addField([
            'name' => 'rating',
            'type' => 'number',
            'label' => 'Рейтинг'
        ]);
        $this->crud->addField([
            'name' => 'skin',
            'type' => 'image',
            'label' => 'Скин'
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
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
            'name' => 'difficulty',
            'type' => 'select_from_array',
            'options' => [
                'easy' => 'Легкая',
                'medium' => 'Средняя',
                'high' => 'Высокая'
            ],
            'label' => 'Название'
        ]);
        $this->crud->addColumn([
            'name' => 'rating',
            'type' => 'number',
            'label' => 'Рейтинг'
        ]);
        $this->crud->addColumn([
            'name' => 'skin',
            'type' => 'image',
            'label' => 'Скин'
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
