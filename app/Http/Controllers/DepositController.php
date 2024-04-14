<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Store;

class DepositController extends Controller
{
    public function index()
    {
        $data = Store::get();
        return View('deposit.index', compact('data'));
    }
}
