<?php

namespace App\Http\Controllers\adminpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminpanelController extends Controller
{
    protected $limit= 6;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permissions');
    }
}
