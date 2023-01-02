<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\FirebaseWrapper;

class Type extends BaseController
{
    private $model;
    private $init = [];
    private $viewParent = 'type';

    function __construct()
    {
        $this->model = new \App\Models\Type();
        $this->init = ['id' => 0];

        foreach($this->model->allowedFields as $elem) {
            $this->init[$elem] = '';
        }
    }

    public function index()
    {
        $this->data['title'] = $this->baseTitle . 'Type';
        $this->data['model'] = [
            'data' => $this->model->paginate($this->basePagination),
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
        $this->data['title'] = $this->baseTitle . 'Create Type';
        $this->data['isUpdate'] = false;
        $this->data['data'] = $this->init;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'description'  => 'required',
        ])) {
            $object = null;
            $var = [
                'name' => $this->request->getPost('name'),
                'description'  => $this->request->getPost('description'),
            ];
            if (!in_array($this->request->getFile('icon')->getPath(), [null, ''])) {
                $object = FirebaseWrapper::getInstance()->upload($this->request->getFile('icon'));
                $var['icon'] = $object['name'];
            }

            $this->model->save($var);
        }

        return $this->index();
    }

    public function edit($id)
    {
        $_result = $this->model->where('md5(id)', $id)->first();

        $this->data['title'] = $this->baseTitle . 'Update Type';
        $this->data['isUpdate'] = true;
        $this->data['data'] = $_result;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'id' => 'required',
            'name' => 'required|min_length[3]|max_length[255]',
            'description'  => 'required',
        ])) {
            $this->model->transStart();
            
            $id = $this->request->getPost('id');
            $var = [
                'name' => $this->request->getPost('name'),
                'description'  => $this->request->getPost('description'),
            ];
            if (!in_array($this->request->getFile('icon')->getPath(), [null, ''])) {
                $row = $this->model->where('md5(id)', md5($id))->first();

                $object = FirebaseWrapper::getInstance()->renew($this->request->getFile('icon'), $row['icon']);
                $var['icon'] = $object['name'];
            }
            $this->model
                ->where('md5(id)', md5($id))
                ->set($var)
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
