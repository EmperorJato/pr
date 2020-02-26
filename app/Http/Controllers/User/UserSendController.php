<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use App\PRForms;
use Illuminate\Support\Carbon;

class UserSendController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index($id){

        $prforms = Products::select('products.*', 'prforms.*', 'users.*')
            ->join('prforms', 'prforms.pr_id', '=', 'products.prform_id')
            ->join('users', 'users.id', 'prforms.user_id')
            ->where('prforms.pr_id', $id)->first();

        $products = Products::where('prform_id', $id)->get();

        return view('user.user-send', compact('prforms', 'products'));
    }
    

    public function approval(Request $request){

        return view('user.user-send');

    }

    public function savePR(Request $request){

        $pr_id = $request->get('pr_id');

        PRForms::where('pr_id', $pr_id)->update([
            'department' => $request->department,
            'project' => $request->project,
            'purpose' => $request->purpose
        ]);
    }

    public function saveProduct(Request $request){

        $p_id = $request->get('edit_id');

        Products::where('p_id', $p_id)->update([

            'product' => $request->edit_product,
            'unit' => $request->edit_unit,
            'quantity' => $request->edit_quantity,
            'price' => $request->edit_price,
            'remarks' => $request->edit_remarks,
            'total' => $request->edit_total

        ]);

    }

    public function destroy(Request $request){

        $delete_id = $request->get('delete_id');
        
        $product = Products::where('p_id', $delete_id);

        $product->delete();

    }

    public function addProduct(Request $request){


        Products::insert([

            'prform_id' => $request->prform_id,
            'product' => $request->product,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'total' => $request->total,
            'remarks' => $request->remarks
            
        ]);

    }

    

    public function requested(Request $request){

        $request_id = $request->get('requested_id');

        $dateNow = Carbon::now();

        $yearNow = $dateNow->year;

        $series_no = PRForms::where('series_no', '<>', null)->first();

       
        $series_1 = 'PR'.$yearNow."-"."0000001";

        if(is_null($series_no)){

            PRForms::where('pr_id', $request_id)->update([
                'series_no' => 1,
                'series' => $series_1,
                'date' => Carbon::now(),
                'status' => 'Requested'
            ]);

        } else {

            $series_no = PRForms::where('series_no', '<>', null)->orderBy('series_no', 'desc')->latest()->first()->series_no + 1;
            $series = 'PR'.$yearNow.'-'.str_pad($series_no, 7, '0', STR_PAD_LEFT);

            PRForms::where('pr_id', $request_id)->update([
                'series_no' => $series_no,
                'series' => $series,
                'date' => Carbon::now(),
                'status' => 'Requested'
            ]);

        }

    }
}