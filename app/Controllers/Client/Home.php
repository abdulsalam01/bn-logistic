<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\FirebaseWrapper;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\Slider;
use App\Models\Tariff;
use App\Models\Team;
use App\Models\Type;

class Home extends BaseController
{
    private $assets = [];
    private $model = null;
    private $other = [];
    private $enum = [];
    private $complex = [];

    function __construct()
    {
        $this->model = model(Contact::class);
        $this->other = [
            model(Type::class), // type 0
            model(Client::class), // client 1
            model(Branch::class), // branch 2
            model(Tariff::class), // tariff 3
            model(Category::class), // category 4
            $this->model, // contact 5
        ];
        $this->complex = [
            new Team(), // team 0
            new Slider(), // slider 1
            new News(), // news 2
            new Portfolio(), // portfolio 3
        ];

        $this->assets = ['url' => 'assets_client', 'base_title' => 'BN Logistic'];
        $this->enum = [
            'portfolio' => getListEnum('portfolio'),
            'news' => getListEnum('news'),
        ];
    }

    public function index()
    {
        $_data = [];
        foreach ($this->other as $elem) {
            array_push($_data, $elem->paginate($this->basePagination));
        }
        $this->assets['data'] = $_data;
        $this->assets['clients'] = $this->prepareClients();
        $this->assets['enum'] = $this->enum;

        return view('client/index', $this->assets);
    }

    public function news($id)
    {
        $_data = [];
        $this->basePagination = 3;
        
        foreach ($this->other as $elem) {
            array_push($_data, $elem->paginate($this->basePagination));
        }
        $this->assets['data'] = $_data;
        $this->assets['enum'] = $this->enum;
        $this->assets['clients'] = $this->prepareClients();
        $this->assets['category'] = $this->other[4]
            ->select('name, COUNT(*) cnt')
            ->groupBy('name')
            ->paginate($this->basePagination);
        $this->assets['news'] = $this->complex[2]
            ->select('news.*, category.name, users.username, users.status_message')
            ->join('category', 'category.id = news.category_id')
            ->join('users', 'users.id = news.created_by')
            ->where('md5(news.id)', $id)
            ->first();
        // remap
        $object = $this->assets['news']['path'];
        $object = FirebaseWrapper::getInstance()->retrieve($object);

        $this->assets['news']['path'] = $object['mediaLink'];
        return view('client/blog', $this->assets);
    }

    public function contact()
    {
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

    /**
     * HELPER
     */
    private function prepareClients()
    {
        $_db = db_connect();
        $_data = [];

        for ($i = 0; $i < count($this->complex); $i++) {
            $flag = false;
            $model = $this->complex[$i];
            $table = strval($model->getTable());

            // joining info
            switch ($table) {
                case 'news':
                    $model = 
                        $model
                            ->select('news.*, category.name, users.username')
                            ->join('category', 'category.id = news.category_id')
                            ->join('users', 'users.id = news.created_by');
                    break;
                case 'other':
                    break;
                default:
            }
            // field existing info
            if ($_db->fieldExists($table . '.is_active', $table)) {
                $model = $model->where('is_active', 1);
            }
            if ($_db->fieldExists($table . '.status', $table)) {
                $model = $model->where('status', 1);
            }
            if ($_db->fieldExists('raw', $table)) {
                $flag = true;
            }

            $model = $model->orderBy('created_at', 'desc');
            $model = $model->paginate($this->basePagination);
            $_result = [];
            $_result[$table] = [];
            for ($j = 0; $j < count($model); $j++) {
                $raw = $flag ? json_decode($model[$j]['raw'])->name : $model[$j]['path'];
                $object = FirebaseWrapper::getInstance()->retrieve($raw);
                $model[$j]['path'] = $object['mediaLink'];

                array_push($_result[$table], $model[$j]);
            }

            $_data[$table] = $_result[$table];
        }

        return $_data;
    }
}
