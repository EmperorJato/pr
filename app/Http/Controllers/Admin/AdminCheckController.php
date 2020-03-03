<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PRForms;
use Illuminate\Support\Carbon;

class AdminCheckController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index(){

        $prform = PRForms::where('checks', '<>', null)->orderBy('checks', 'desc')->paginate(10);

    
        return view('admin.admin-check', compact('prform'));

    }

    public function issue(Request $request){

        $status_id = $request->get('status_id');

        PRForms::where('pr_id', $status_id)->update([

            'checks' => Carbon::now()

        ]);

    }

    public function search(Request $request){

        $search = $request->get('search');

        if($search != ""){

            $prform = PRForms::where('date', 'like', '%'.$search.'%')
            ->where('checks', '<>', null)
            ->orWhere('series', 'like', '%'.$search.'%')
            ->where('checks', '<>', null)
            ->orWhere('requestor', 'like', '%'.$search.'%')
            ->where('checks', '<>', null)
            ->orWhere('project', 'like', '%'.$search.'%')
            ->where('checks', '<>', null)
            ->orWhere('purpose', 'like', '%'.$search.'%')
            ->where('checks', '<>', null)
            ->orderBy('date', 'desc')
            ->paginate(10);

            $prform->appends(['search' => $search]);

            return view('admin.admin-check', compact('prform'));

        }

        return redirect()->route('admin-check');
    }
}
