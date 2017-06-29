<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Smalot\PdfParser\parser;
use PhpOffice\PhpWord\PhpWord;


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
       
        // Read contents
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($file);

        $sections = $phpWord->getSections();
        $text = "";

        foreach ($sections as $s) {
            $ele = $s->getElements();
            foreach ($ele as $e) {
                if (get_class($e) === 'PhpOffice\PhpWord\Element\Text') {
                    $text .= $e->getText() . " \n";
                } elseif (get_class($e) === 'PhpOffice\PhpWord\Element\TextBreak') {
                    // echo "tb";
                    $text .= " \n";
                } elseif (get_class($e) === 'PhpOffice\PhpWord\Element\TextRun' ) {
                    $r = $e->getElements();
                    foreach ($r as $a) {
                       $text .= $a->getText() . " \n";
                    }
                } else {
                    // throw new Exception('Unknown class type ' . get_class($e));
                }
            }
        }

    	return $text;
    }
}
