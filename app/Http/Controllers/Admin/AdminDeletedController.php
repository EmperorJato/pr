<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PRForms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDeletedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $prform = PRForms::where('status', 'Removed')->orderBy('date', 'desc')->paginate(10);

        return view('admin.admin-deleted', compact('prform'));
        
    }

    
    public function search(Request $request){

        $search = $request->get('search');

        if($search != ""){

            $prform = PRForms::where('user_id', Auth::user()->id)
            ->where('date', 'like', '%'.$search.'%')
            ->where('status', '=', 'Removed')
            ->orWhere('requestor', 'like', '%'.$search.'%')
            ->where('status', '=', 'Removed')
            ->orWhere('series', 'like', '%'.$search.'%')
            ->where('status', '=', 'Removed')
            ->orWhere('project', 'like', '%'.$search.'%')
            ->where('status', '=', 'Removed')
            ->orWhere('purpose', 'like', '%'.$search.'%')
            ->where('status', '=', 'Removed')
            ->orderBy('date', 'desc')
            ->paginate(10);

            $prform->appends(['search' => $search]);

            return view('admin.admin-deleted', compact('prform'));

        }

        return redirect()->route('admin-removed');
    }

}
