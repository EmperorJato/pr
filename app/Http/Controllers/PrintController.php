<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;


class PrintController extends Controller
{
    

    public function view_print($id){

        $data = [

            'report_path' => '/reports/PR/pr_report',
            'controls' => ['pr_id' => $id]

        ];
        
        return response()->view('pages.print', $data)->header('Content-type', 'application/pdf');

    }

    public function index($id){

        $prforms = Products::select('products.*', 'prforms.*', 'users.*')
            ->join('prforms', 'prforms.pr_id', '=', 'products.prform_id')
            ->join('users', 'users.id', 'prforms.user_id')
            ->where('prforms.pr_id', $id)->first();

        $products = Products::where('prform_id', $id)->get();

        return view('pages.view-request', compact('prforms', 'products'));

    }

    
    public function adminIndex($id){

        $prforms = Products::select('products.*', 'prforms.*', 'users.*')
            ->join('prforms', 'prforms.pr_id', '=', 'products.prform_id')
            ->join('users', 'users.id', 'prforms.user_id')
            ->where('prforms.pr_id', $id)->first();

        $products = Products::where('prform_id', $id)->get();

        return view('pages.admin-view-request', compact('prforms', 'products'));

    }


}


 
