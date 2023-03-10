<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Tariff extends BaseController
{
    private $model;
    private $init = [];
    private $viewParent = 'tariff';

    function __construct()
    {
        $this->model = new \App\Models\Tariff();
        $this->init = ['id' => 0];

        foreach($this->model->allowedFields as $elem) {
            $this->init[$elem] = '';
        }
    }

    public function index()
    {
        $this->data['title'] = $this->baseTitle . 'Tariff';
        $this->data['model'] = [
            'data' => $this->model->paginate($this->basePagination),
            'pager' => $this->model->pager,
        ];
        return view($this->baseView . $this->viewParent . '/list', $this->data);
    }

    public function store()
    {
        $this->data['title'] = $this->baseTitle . 'Create Tariff';
        $this->data['isUpdate'] = false;
        $this->data['data'] = $this->init;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'raw_source' => 'required|min_length[3]|max_length[255]',
            'packet_type'  => 'required',
            'estimation_time' => 'required|valid_date',
            'weight_range' => 'required',
            'price_range' => 'required',
        ])) {
            $this->model->save($this->request->getPost());
        }
        
        return $this->index();
    }

    public function edit($id)
    {
        $_result = $this->model->where('md5(id)', $id)->first();

        $this->data['title'] = $this->baseTitle . 'Update Tariff';
        $this->data['isUpdate'] = true;
        $this->data['data'] = $_result;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'id' => 'required',
            'raw_source' => 'required|min_length[3]|max_length[255]',
            'packet_type'  => 'required',
            'estimation_time' => 'required|valid_date',
            'weight_range' => 'required',
            'price_range' => 'required',
        ])) {
            $id = $this->request->getPost('id');

            $this->model
                ->where('md5(id)', md5($id))
                ->set($this->request->getPost())
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
