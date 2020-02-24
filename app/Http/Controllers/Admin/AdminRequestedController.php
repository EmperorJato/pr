<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PRForms;

class AdminRequestedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $prform = PRForms::where('status', 'Approved')->paginate(10);

        return view('admin.admin-requested', compact('prform'));
        
    }
}
