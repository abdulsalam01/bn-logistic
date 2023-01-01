<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\FirebaseWrapper;

class Slider extends BaseController
{
    private $model;
    private $init = [];
    private $viewParent = 'slider';

    function __construct()
    {
        $this->model = new \App\Models\Slider();
        $this->init = ['id' => 0];

        foreach($this->model->allowedFields as $elem) {
            $this->init[$elem] = '';
        }
    }

    public function index()
    {
        $this->data['title'] = $this->baseTitle . 'Slider';
        $this->data['model'] = [
            'data' => $this->model->paginate($this->basePagination),
            'pager' => $this->model->pager,
        ];
        return view($this->baseView . $this->viewParent . '/list', $this->data);
    }

    public function store()
    {
        $this->data['title'] = $this->baseTitle . 'Create Slider';
        $this->data['isUpdate'] = false;
        $this->data['data'] = $this->init;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'path' => 'uploaded[path]|max_size[path,2048]|ext_in[path,png,jpg,gif]',
        ])) {
            $this->model->transStart();

            $object = FirebaseWrapper::getInstance()->upload($this->request->getFile('path'));
            $this->model->save([
                'path' => $object['mediaLink'],
                'path_description'  => $this->request->getPost('path_desc'),
                'raw' => json_encode($object),
            ]);

            $this->model->transComplete();
        }

        return $this->index();
    }

    public function edit($id)
    {
        $_result = $this->model->where('md5(id)', $id)->first();

        $this->data['title'] = $this->baseTitle . 'Update Branch';
        $this->data['isUpdate'] = true;
        $this->data['data'] = $_result;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'id' => 'required',
            'path' => 'uploaded[path]|max_size[path,2048]|ext_in[path,png,jpg,gif]',
        ])) {
            $this->model->transStart();

            $id = $this->request->getPost('id');
            $row = $this->model->where('md5(id)', md5($id));
            $rowJson = json_decode($row->first()['raw']);
            $object = FirebaseWrapper::getInstance()->renew($this->request->getFile('path'), $rowJson->name);

            $this->model
                ->where('md5(id)', md5($id))
                ->set([
                    'path' => $object['mediaLink'],
                    'path_description'  => $this->request->getPost('path_desc'),
                    'raw'  => json_encode($object),
                ])
                ->update();
            $this->model->transComplete();
        }

        return $this->index();
    }

    public function destroy($id)
    {
        $this->model->transStart();

        $row = $this->model->where('md5(id)', $id)->first();
        $rowJson = json_decode($row['raw']);
        $rowJson = $rowJson->name;

        FirebaseWrapper::getInstance()->remove($rowJson);
        $_result = $this->model->where('md5(id)', $id)->delete();

        $this->model->transComplete();
        return $this->index();
    }
}
