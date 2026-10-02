<?php

namespace app\controllers\Customer;

use app\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->renderCustomer('home/index');
    }
}