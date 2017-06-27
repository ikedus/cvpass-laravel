<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\cvparseRepository;

class cvparseController extends Controller
{	

	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(cvparseRepository $cv)
    {
    	return view("upload");
    }

    public function formResponse(Request $request,cvparseRepository $cv)
    {
    	return $cv->parse($request);
    }
}
