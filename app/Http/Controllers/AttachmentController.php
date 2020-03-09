<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Attachment;

class AttachmentController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }


}
