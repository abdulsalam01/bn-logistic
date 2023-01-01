<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\FirebaseWrapper;

class Client extends BaseController
{
    private $model;
    private $init = [];
    private $viewParent = 'client';

    function __construct()
    {
        $this->model = new \App\Models\Client();
        $this->init = ['id' => 0];

        foreach($this->model->allowedFields as $elem) {
            $this->init[$elem] = '';
        }
    }

    public function index()
    {
        $this->data['title'] = $this->baseTitle . 'Client';
        $this->data['model'] = [
            'data' => $this->model->paginate($this->basePagination / 2),
            'pager' => $this->model->pager,
        ];

        // remap
        foreach($this->data['model']['data'] as $k => $elem) {
            $object = FirebaseWrapper::getInstance()->retrieve($elem['icon']);
            $object = $object['mediaLink'];

            $this->data['model']['data'][$k]['icon'] = $object;
        }
        return view($this->baseView . $this->viewParent . '/list', $this->data);
    }

    public function store()
    {
        $this->data['title'] = $this->baseTitle . 'Create Client';
        $this->data['isUpdate'] = false;
        $this->data['data'] = $this->init;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'icon' => 'uploaded[icon]|max_size[icon,2048]|ext_in[icon,png,jpg,gif]',
        ])) {
            $this->model->transStart();
            $object = FirebaseWrapper::getInstance()->upload($this->request->getFile('icon'));
            $this->model->save([
                'name' => $this->request->getPost('name'),
                'icon'  => $object['name'],
            ]);
            $this->model->transComplete();
        }

        return $this->index();
    }

    public function edit($id)
    {
        $_result = $this->model->where('md5(id)', $id)->first();

        $this->data['title'] = $this->baseTitle . 'Update Client';
        $this->data['isUpdate'] = true;
        $this->data['data'] = $_result;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'id' => 'required',
            'name' => 'required|min_length[3]|max_length[255]',
            'icon' => 'uploaded[icon]|max_size[icon,2048]|ext_in[icon,png,jpg,gif]',            
        ])) {
            $this->model->transStart();

            $id = $this->request->getPost('id');
            $row = $this->model->where('md5(id)', md5($id))->first();
            $rowJson = $row['icon'];
            $object = FirebaseWrapper::getInstance()->renew($this->request->getFile('icon'), $rowJson);

            $this->model
                ->where('md5(id)', md5($id))
                ->set([
                    'name' => $this->request->getPost('name'),
                    'icon' => $object['name'],
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
        $rowJson = $row['icon'];

        FirebaseWrapper::getInstance()->remove($rowJson);
        $_result = $this->model->where('md5(id)', $id)->delete();

        $this->model->transComplete();
        return $this->index();
    }
}
