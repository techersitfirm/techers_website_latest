<?php

namespace App\Controllers\Customer;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->renderCustomer('home/index');
    }
}