<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\FirebaseWrapper;

class News extends BaseController
{
    private $model;
    private $join;
    private $enum;
    private $init = [];
    private $viewParent = 'news';

    function __construct()
    {
        $this->model = new \App\Models\News();
        $this->join = model(Category::class);
        $this->enum = getListEnum('news');
        $this->init = ['id' => 0];

        foreach($this->model->allowedFields as $elem) {
            $this->init[$elem] = '';
        }
    }

    public function index()
    {
        $query = $this->model
            ->select('news.*, category.name, users.username')
            ->join('category', 'category.id = news.category_id')
            ->join('users', 'users.id = news.created_by');
        $this->data['title'] = $this->baseTitle . 'News';
        $this->data['model'] = [
            'data' => $query->paginate($this->basePagination),
            'pager' => $this->model->pager,
        ];

        // remap
        foreach($this->data['model']['data'] as $k => $elem) {
            if (empty($elem['path'])) continue;

            $object = FirebaseWrapper::getInstance()->retrieve($elem['path']);
            $object = $object['mediaLink'];

            $this->data['model']['data'][$k]['path'] = $object;
        }

        return view($this->baseView . $this->viewParent . '/list', $this->data);
    }

    public function store()
    {
        $this->data['title'] = $this->baseTitle . 'Create News';
        $this->data['isUpdate'] = false;
        $this->data['data'] = $this->init;
        $this->data['category'] = $this->join->paginate($this->basePagination);
        $this->data['enum'] = $this->enum;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[10]|max_length[255]',
            'description' => 'required|min_length[10]|max_length[255]',
            'path' => 'uploaded[path]|max_size[path,2048]|ext_in[path,png,jpg,gif]',
            'type' => 'required',
            'category_id' => 'required',
        ])) {
            $this->model->transStart();

            $object = FirebaseWrapper::getInstance()->upload($this->request->getFile('path'));
            $created_by = ['created_by' => auth()->id()];
            $path = ['path' => $object['name']];
            $var = array_merge($this->request->getPost(), $created_by, $path);

            $this->model->save($var);
            $this->model->transComplete();
        }

        return $this->index();
    }

    public function edit($id)
    {
        $_result = $this->model->where('md5(id)', $id)->first();

        $this->data['title'] = $this->baseTitle . 'Update News';
        $this->data['isUpdate'] = true;
        $this->data['data'] = $_result;
        $this->data['category'] = $this->join->paginate($this->basePagination);
        $this->data['enum'] = $this->enum;

        return view($this->baseView . $this->viewParent . '/create', $this->data);
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'id' => 'required',
            'title' => 'required|min_length[10]|max_length[255]',
            'description' => 'required|min_length[10]|max_length[255]',
            'path' => 'uploaded[path]|max_size[path,2048]|ext_in[path,png,jpg,gif]',
            'type' => 'required',
            'category_id' => 'required',
        ])) {
            $this->model->transStart();

            $id = $this->request->getPost('id');
            $var = $this->request->getPost();
            $created_by = ['created_by' => auth()->id()];
            if (!in_array($this->request->getFile('path')->getPath(), [null, ''])) {
                $row = $this->model->where('md5(id)', md5($id))->first();
                $rowJson = $row['path'];

                $object = FirebaseWrapper::getInstance()->renew($this->request->getFile('path'), $rowJson);
                $var = array_merge($var, ['path' => $object['name']]);
            }
            $var = array_merge($var, $created_by);
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
