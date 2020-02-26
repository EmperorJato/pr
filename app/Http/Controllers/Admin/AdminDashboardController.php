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

        $prform = PRForms::where('status', '=', 'Requested')->orderBy('series_no', 'asc')->paginate(10);

        return view('admin.admin-dashboard', compact('prform'));

    }

    public function view($id){

        $prforms = Products::select('products.*', 'prforms.*', 'users.*')
        ->join('prforms', 'prforms.pr_id', '=', 'products.prform_id')
        ->join('users', 'users.id', 'prforms.user_id')
        ->where('prforms.pr_id', $id)->first();

        $products = Products::where('prform_id', $id)->get();

        return view('admin.admin-view', compact('prforms', 'products'));

    }


    public function approve(Request $request){

        $status_id = $request->get('status_id');

        PRForms::where('pr_id', $status_id)->update([

            'approve' => Auth::user()->name,
            'status' => 'Approved',
            'status_date' => Carbon::now()

        ]);

    }

    public function remove(Request $request){

        $status_id = $request->get('status_id');

        PRForms::where('pr_id', $status_id)->update([

            'status' => 'Removed',
            
        ]);

    }

    public function restore(Request $request){

        $status_id = $request->get('status_id');

        PRForms::where('pr_id', $status_id)->update([

            'status' => 'Approved',

        ]);

    }

    public function deleted(Request $request){

        $status_id = $request->get('status_id');

        PRForms::where('pr_id', $status_id)->update([

            'approve' => Auth::user()->name,
            'status' => 'Deleted',
            'status_date' => Carbon::now()

        ]);

    }

    public function search(Request $request){

        $search = $request->get('search');

        if($search != ""){

            $prform = PRForms::where('user_id', Auth::user()->id)
            ->where('date', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orWhere('series', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orWhere('requestor', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orWhere('project', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orWhere('purpose', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orderBy('series_no', 'asc')
            ->paginate(10);

            $prform->appends(['search' => $search]);

            return view('admin.admin-dashboard', compact('prform'));

        }

        return redirect()->route('admin-dashboard');
    }

}
