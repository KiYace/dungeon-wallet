<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlayerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PlayerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PlayerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Player::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/player');
        CRUD::setEntityNameStrings('игрок', 'игроки');
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
            'name' => 'nickname',
            'type' => 'text',
            'label' => 'Ник'
        ]);
        $this->crud->addColumn([
            'name' => 'mail',
            'type' => 'text',
            'label' => 'Почта'
        ]);
        $this->crud->addColumn([
            'name' => 'skin',
            'type' => 'relationship',
            'label' => 'Скин',
            'entity' => 'skin',
            'attribute' => 'name'
        ]);
        $this->crud->addColumn([
            'name' => 'push_enabled',
            'type' => 'check',
            'label' => 'Пуш уведомления'
        ]);
        $this->crud->addColumn([
            'name' => 'push_token',
            'type' => 'text',
            'label' => 'Пуш токен'
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
        CRUD::setValidation(PlayerRequest::class);

        $this->crud->addField([
            'name' => 'nickname',
            'type' => 'text',
            'label' => 'Ник'
        ]);
        $this->crud->addField([
            'name' => 'mail',
            'type' => 'text',
            'label' => 'Почта'
        ]);

        // TODO удалить
        $this->crud->addField([
            'name' => 'password',
            'type' => 'text',
            'label' => 'Пароль'
        ]);
        $this->crud->addField([
            'name' => 'skin',
            'type' => 'relationship',
            'label' => 'Скин',
            'entity' => 'skin',
            'attribute' => 'name'
        ]);
        $this->crud->addField([
            'name' => 'push_enabled',
            'type' => 'checkbox',
            'label' => 'Пуш уведомления'
        ]);
        $this->crud->addField([
            'name' => 'push_token',
            'type' => 'text',
            'label' => 'Пуш токен'
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
            'name' => 'nickname',
            'type' => 'text',
            'label' => 'Ник'
        ]);
        $this->crud->addColumn([
            'name' => 'mail',
            'type' => 'text',
            'label' => 'Почта'
        ]);
        $this->crud->addColumn([
            'name' => 'skin',
            'type' => 'relationship',
            'label' => 'Скин',
            'entity' => 'skin',
            'attribute' => 'name'
        ]);
        $this->crud->addColumn([
            'name' => 'push_enabled',
            'type' => 'check',
            'label' => 'Пуш уведомления'
        ]);
        $this->crud->addColumn([
            'name' => 'push_token',
            'type' => 'text',
            'label' => 'Пуш токен'
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
        $this->crud->addColumn([
            'name' => 'deleted_at',
            'type' => 'date',
            'label' => 'Дата удаления'
        ]);
    }
}
