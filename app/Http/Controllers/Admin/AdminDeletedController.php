<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PRForms;
use Illuminate\Http\Request;

class AdminDeletedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $prform = PRForms::where('status', 'Removed')->paginate(10);

        return view('admin.admin-deleted', compact('prform'));
        
    }

}
