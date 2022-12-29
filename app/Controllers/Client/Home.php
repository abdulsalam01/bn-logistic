<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\Contact;

class Home extends BaseController
{
    private $assets = [];
    private $model = null;

    function __construct()
    {
        $this->model = model(Contact::class);
        $this->assets = ['url' => 'assets_client'];
    }

    public function index()
    {
        return view('client/index', $this->assets);
    }

    public function news() {
        return view('client/blog', $this->assets);
    }

    public function contact() {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'email'  => 'required|valid_email',
            'subject' => 'required|min_length[4]',
            'message' => 'required'
        ])) {
            $this->model->save($this->request->getPost());
        }

        return "OK";
    }
}
