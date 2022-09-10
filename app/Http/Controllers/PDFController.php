<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Reports;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function streamPDF(Reports $report)
    {
        $pdf = PDF::loadView('pages.reports.show', compact('report'));
        // return $pdf->download('reports.pdf');
        $pdf->set_paper('letter', 'portrait');
        return $pdf->stream('reports.pdf', array('Attachment' => false));

        // return view('pages.reports.show', compact('report'));
    }
}
