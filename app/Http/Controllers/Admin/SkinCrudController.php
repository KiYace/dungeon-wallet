<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SkinRequest;
use App\Service\Image\ImageUploader;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SkinCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SkinCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
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
        CRUD::setModel(\App\Models\Skin::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/skin');
        CRUD::setEntityNameStrings('скин', 'скины');
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
            'name' => 'rating',
            'type' => 'number',
            'label' => 'Рейтинг'
        ]);
        $this->crud->addColumn([
            'name' => 'skin',
            'type' => 'image',
            'label' => 'Скин'
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
        CRUD::setValidation(SkinRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
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
            'name' => 'rating',
            'type' => 'number',
            'label' => 'Рейтинг'
        ]);
        $this->crud->addColumn([
            'name' => 'skin',
            'type' => 'image',
            'label' => 'Скин'
        ]);
    }

    public function store()
    {
        $request = $this->crud->getRequest()->request;
        $image = $request->get('skin');
        $request->remove('skin');

        /**
         * @var ImageUploader $ImageUploader
         */
        $ImageUploader = app()->make(ImageUploader::class);
        $ImageUploader->setDisk('skins');
        $ImageUploader->setPath($request->get('name'));
        $filePath = $ImageUploader->storeBase64($image);
        $request->add(['skin' => $filePath]);

        $response = $this->traitStore();
        return $response;
    }
}
