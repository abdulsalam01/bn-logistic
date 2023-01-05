<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\FirebaseWrapper;

class Team extends BaseController
{
    private $model;
    private $init = [];
    private $viewParent = 'team';

    function __construct()
    {
        $this->model = new \App\Models\Team();
        $this->init = ['id' => 0];

        foreach($this->model->allowedFields as $elem) {
            $this->init[$elem] = '';
        }
    }

    public function index()
    {
        $this->data['title'] = $this->baseTitle . 'Team';
        $this->data['model'] = [
            'data' => $this->model->paginate($this->basePagination),
            'pager' => $this->model->pager,
        ];
        // remap
        foreach($this->data['model']['data'] as $k => $elem) {
            $object = FirebaseWrapper::getInstance()->retrieve($elem['path']);
            $object = $object['mediaLink'];

            $this->data['model']['data'][$k]['path'] = $object;
        }        
        return view($this->baseView . $this->viewParent . '/list', $this->data);
    }

    public function store()
    {
        $this->data['title'] = $this->baseTitle . 'Create Team';
        $this->data['isUpdate'] = false;
        $this->data['data'] = $this->init;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'role' => 'required',
            'path' => 'uploaded[path]|max_size[path,2048]|ext_in[path,png,jpg,gif]',
        ])) {
            $object = FirebaseWrapper::getInstance()->upload($this->request->getFile('path'));
            $var = [
                'name' => $this->request->getPost('name'),
                'role' => $this->request->getPost('role'),
                'path' => $object['name'],
                'is_active' => convertBooleanToInteger($this->request->getPost('is_active')),
                'media' => $this->request->getPost('media') ?? '',
            ];

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
            'role' => 'required',
            'path' => 'uploaded[path]|max_size[path,2048]|ext_in[path,png,jpg,gif]',
        ])) {
            $this->model->transStart();
            
            $id = $this->request->getPost('id');
            $var = [
                'name' => $this->request->getPost('name'),
                'role' => $this->request->getPost('role'),
                'is_active' => convertBooleanToInteger($this->request->getPost('is_active')),
                'media' => $this->request->getPost('media') ?? '',
            ];
            if (!in_array($this->request->getFile('path')->getPath(), [null, ''])) {
                $row = $this->model->where('md5(id)', md5($id))->first();
                $object = FirebaseWrapper::getInstance()->renew($this->request->getFile('path'), $row['path']);
                $var['path'] = $object['name'];
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
        $rowJson = $row['path'];

        FirebaseWrapper::getInstance()->remove($rowJson);
        $_result = $this->model->where('md5(id)', $id)->delete();

        $this->model->transComplete();
        return $this->index();
    }
}
