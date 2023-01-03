<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->data['title'] = $this->baseTitle . 'Dashboard';
        return view('admin/dashboard', $this->data);
    }

    public function profile() {
        $this->data['title'] = $this->baseTitle . 'Profile';
        return view('admin/user', $this->data);
    }
}
