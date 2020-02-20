<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PRForms;
use App\Products;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class UserDashboardController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index(){

        return view('user.user-dashboard');

    }

    public function create(array $data){

        $dateNow = Carbon::now();


          
        return PRForms::create([

            'user_id' => Auth::user()->id,
            'requestor' => Auth::user()->name,
            'date' => $dateNow,
            'department' => $data['department'],
            'project' => $data['project'],
            'purpose' => $data['purpose']
            
        ]);

    }

    public function store(Request $request){
        
        $pr_id = $this->create($request->all())->id;

        if(count($request->product) > 0){
            foreach($request->product as $item => $a){
                $data = array(
                    'prform_id' => $pr_id,
                    'product' => $request->product[$item],
                    'quantity' => $request->quantity[$item],
                    'unit' => $request->unit[$item],
                    'price' => $request->price[$item],
                    'total' => $request->total[$item],
                    'remarks' => $request->remarks[$item]
                );

                Products::insert($data);
            }
        }

        return response()->json(['pr_id' => $pr_id, 'requestor' => Auth::user()->name]);
    }

}
