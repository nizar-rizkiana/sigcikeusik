<?php

namespace App\Controllers;
use App\Models\OperatorModel;

class Profile extends BaseController
{
    protected $OperatorModel;

    public function __construct()
    {
        $this->operatorModel = new OperatorModel();
    }

    public function index()
    {
        return view('profile');
    }
}
