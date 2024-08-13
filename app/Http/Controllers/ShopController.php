<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('/pages/shop');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}