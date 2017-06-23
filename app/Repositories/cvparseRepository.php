<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cvparseRepository extends Controller
{
    
    protected $cv;

    function __construct()
    {
    	
    }

    public function parse($file)
    {
    	switch (pathinfo($file, PATHINFO_EXTENSION)) {
    		case 'pdf':
    			return "hoi je bestandje is een pdf";
    			break;

    		case 'docx':
    			return "hoi je bestandje is docx";
    			break;
    		
    		default:
    			return "bestands type " . pathinfo($file, PATHINFO_EXTENSION) . " niet ondersteund ofzo";
    			break;
    	}
    }
}
