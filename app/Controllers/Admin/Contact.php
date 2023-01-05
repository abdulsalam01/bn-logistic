<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Contact extends BaseController
{
    private $model;
    private $init = [];
    private $viewParent = 'contact';

    function __construct()
    {
        $this->model = new \App\Models\Contact();
        $this->init = ['id' => 0];

        foreach($this->model->allowedFields as $elem) {
            $this->init[$elem] = '';
        }
    }

    public function index()
    {
        $this->data['title'] = $this->baseTitle . 'Contact';
        $this->data['model'] = [
            'data' => $this->model->paginate($this->basePagination),
            'pager' => $this->model->pager,
        ];
        return view($this->baseView . $this->viewParent . '/list', $this->data);
    }

    public function store()
    {
        $this->data['title'] = $this->baseTitle . 'Create Contact';
        $this->data['isUpdate'] = false;
        $this->data['data'] = $this->init;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'email'  => 'required|valid_email',
            'subject' => 'required|min_length[4]',
            'message' => 'required'
        ])) {
            $var = array_merge($this->request->getPost(), [
                'is_active' => convertBooleanToInteger($this->request->getPost('is_active'))
            ]);
            $this->model->save($var);
        }
        
        return $this->index();
    }

    public function edit($id)
    {
        $_result = $this->model->where('md5(id)', $id)->first();

        $this->data['title'] = $this->baseTitle . 'Update Contact';
        $this->data['isUpdate'] = true;
        $this->data['data'] = $_result;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'id' => 'required',
            'name' => 'required|min_length[3]|max_length[255]',
            'email'  => 'required|valid_email',
            'subject' => 'required|min_length[4]',
            'message' => 'required'
        ])) {
            $id = $this->request->getPost('id');
            $var = array_merge($this->request->getPost(), [
                'is_active' => convertBooleanToInteger($this->request->getPost('is_active'))
            ]);
            $this->model
                ->where('md5(id)', md5($id))
                ->set($var)
                ->update();
        }

        return $this->index();
    }

    public function destroy($id)
    {
        $this->model->where('md5(id)', $id);
        $_result = $this->model->delete();

        return $this->index();
    }
}
