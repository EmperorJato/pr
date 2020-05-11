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

    public function profile($id){

        if(Auth::user()->id == $id){

            $user = User::find($id);

            return view('admin.admin-profile', ['user' => $user]);
        }

        return back();


    }

    public function upload(Request $request){

        $upload = $request->file('upload');

        $upload->move(public_path('images'), $upload->getClientOriginalName());

        User::where('id', Auth::user()->id)->update([
            'user_avatar' => $upload->getClientOriginalName(),
        ]);
    }

    public function profile_validate(array $data){
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
        ]);
    }

    public function save_profile(Request $request){

        $this->profile_validate($request->all())->validate();

        $arr = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname
        ];

        $name = implode(" ", $arr);
        User::where('id', Auth::user()->id)->update([
            'name' => $name,
        ]);
    }

    public function messages(){
        return view('admin.admin-messages');
    }


}
