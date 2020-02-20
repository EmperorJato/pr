<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PrintController extends Controller
{
    

    public function view_print($id){

        $data = [

            'report_path' => '/reports/PR/pr_report',
            'controls' => ['pr_id' => $id]

        ];
        
        return response()->view('pages.print', $data)->header('Content-type', 'application/pdf');

    }


}


 
