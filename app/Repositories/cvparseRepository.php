<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Smalot\PdfParser\parser;

class cvparseRepository extends Controller
{
    
    protected $cv;

    function __construct()
    {
    	
    }

    public function parse($request)
    {	
    	$file = $request->file('file');
    	// dd($file);
    	$this->validate($request, [
        'file' => 'required|mimes:pdf,docx,doc,txt',
    	]);
    	switch ($request->file->extension()) {
    		case 'pdf':
    			return $this->pdfparse($file);
    			break;

    		case 'docx':
    			return $this->docxparse($file);;
    			break;
    		
    		default:
    			return "bestands type " . $request->file->extension() . " niet ondersteund ofzo";
    			break;
    	}
    }

    public function pdfparse($file)
    {
    	$parsedpdf = new parser;
    	$pdf    = $parsedpdf->parseFile($file);
    	$text = $pdf->getText();
    	return $text;
    }

    public function docxparse($file)
    {
    	return "dit bericht komt uit de docxparse functie";
    }
}
