<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PRForms;
use App\Products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\User;
use App\Message;

class AccountsController extends Controller
{
    public function index($id){

        $user = User::where('id', $id)->first();
        $projects = PRForms::where('user_id', $id)->where('status', 'Approved')->get()->unique('project');
        $total = Products::join('prforms', 'prforms.pr_id', 'products.prform_id')->where('user_id', $id)->where('status', 'Approved')->sum('total');
        return view('admin.admin-account', ['user' => $user, 'projects' => $projects, 'total' => $total]);
    }

    public function getProject(Request $request){
        $id = $request->get('id');
        $proj = $request->get('val');
        $project = PRForms::where('user_id', $id)
        ->where('project', $proj)
        ->where('status', 'Approved')->get();
        $output = '<p><b>PRF</b></p>';
        $output .= '<div class="table">
        <table class="table">
            <thead class=" text-primary">
                <tr>
                    <th style="display: none;">ID</th>
                    <th>#</th>
                    <th>Date</th>
                    <th>Series</th>
                </tr>
            </thead>
            <tbody>';
            foreach($project as $key => $item){
                $output .= '<tr>'.
                '<td style="display: none;">'.$item->pr_id.'</td>'.
                '<td>'.++$key.'</td>'.
                '<td>'.Carbon::parse($item->date)->format('m-d-Y').'</td>'.
                '<td>'.$item->series.'</td>'.
                '</tr>';
            };
        $output .= '</tbody></table>';
        $output .= '<div class="text-left"><button class="btn btn-primary" id="viewProducts">View all products</button></div>
        </div>';
        echo $output;
    }

    public function getProduct(Request $request){
        $id = $request->get('id');
        $proj = $request->get('val');
        $project = Products::join('prforms', 'prforms.pr_id', 'products.prform_id')
        ->where('user_id', $id)
        ->where('project', $proj)
        ->where('status', 'Approved')->get();
        
        $output = '';
        $output .= '<div class="table">
        <table class="table">
        <thead class=" text-primary">
        <tr>
        <th style="display: none;">ID</th>
        <th>#</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Price</th>
        <th>Total</th>
        <th>Remarks</th>
        </tr>
        </thead>
        <tbody>';
        
        foreach($project as $key => $item){
            $output .= '<tr>'.
            '<td style="display: none;">'.$item->pr_id.'</td>'.
            '<td>'.++$key.'</td>'.
            '<td>'.$item->product.'</td>'.
            '<td>'.$item->quantity.'</td>'.
            '<td>'.$item->unit.'</td>'.
            '<td>'.$item->price.'</td>'.
            '<td class="total">'.$item->total.'</td>'.
            '<td>'.$item->remarks.'</td>'.
            '</tr>';
        };
        $output .= '</tbody></table>';
       
        echo $output;
    }
}
