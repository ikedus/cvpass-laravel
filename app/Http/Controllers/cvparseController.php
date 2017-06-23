<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\cvparseRepository;

class cvparseController extends Controller
{
    public function index(cvparseRepository $cv)
    {
    	return "hier moet upload formuliertje komen";
    }

    public function formResponse(Request $request,cvparseRepository $cv)
    {
    	return $cv->parse("kaaskoekje.docx");
    }
}
