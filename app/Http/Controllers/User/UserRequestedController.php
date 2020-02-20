<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PRForms;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserRequestedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){

        $prform =  PRForms::where('user_id', Auth::user()->id)
        ->where('status', '=', 'Requested')->orderBy('series_no', 'asc')->paginate(10);

        return view('user.user-requested', compact('prform'));

    }

    public function search(Request $request){

        $search = $request->get('search');

        if($search != ""){

            $prform = PRForms::where('user_id', Auth::user()->id)
            ->where('date', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orWhere('series', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orWhere('project', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orWhere('purpose', 'like', '%'.$search.'%')
            ->where('status', '=', 'Requested')
            ->orderBy('series_no', 'asc')
            ->paginate(10);

            $prform->appends(['search' => $search]);

            return view('user.user-requested', compact('prform'));

        }

        return redirect()->route('user-requested');
    }

}
