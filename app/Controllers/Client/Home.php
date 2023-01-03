<?php

namespace App\Controllers\Client;

use App\Controllers\Admin\Team;
use App\Controllers\BaseController;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Slider;
use App\Models\Tariff;
use App\Models\Type;

class Home extends BaseController
{
    private $assets = [];
    private $model = null;
    private $other = [];

    function __construct()
    {
        $this->model = model(Contact::class);
        $this->other = [
            model(Type::class), // type 0
            model(News::class), // news 1
            model(Client::class), // client 2
            model(Branch::class), // branch 3
            model(Slider::class), // slider 4
            model(Tariff::class), // tariff 5
            model(Contact::class), // contact 6
            model(Category::class), // category 7
            model(Team::class), // team 8
        ];
        $this->assets = ['url' => 'assets_client', 'base_title' => 'BN Logistic'];
    }

    public function index()
    {
        $_data = [];
        foreach($this->other as $elem) {
            array_push($_data, $elem->paginate($this->basePagination));
        }
        $this->assets['data'] = $_data;
        
        return view('client/index', $this->assets);
    }

    public function news($id) {
        $_data = [];
        foreach($this->other as $elem) {
            array_push($_data, $elem->paginate($this->basePagination));
        }
        $this->assets['data'] = $_data;
        $this->assets['news'] = $this->other[1]->where('md5(id)', $id)->first();

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
