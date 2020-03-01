<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PRForms;
use App\Products;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $date =  Carbon::parse(now())->format('Y-m-d');

        $today_pr = PRForms::where('status', 'Requested')->where('date', $date)->count();

        $pr = PRForms::where('status', 'Requested')->count(); 

        $prform = PRForms::where('status', 'Requested')->first();

        $total = null;

        if($prform){

    
            $total = PRForms::select('prforms.*', 'products.*')->leftJoin('products', 'products.prform_id', '=', 'prforms.pr_id')->where('status', 'Requested')->sum('total');
        }

        return view('admin.admin-dashboard', compact('today_pr', 'pr', 'total', 'prform'));

    }


}
