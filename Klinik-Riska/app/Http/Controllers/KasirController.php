<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasir;
use Barryvdh\DomPDF\Facade\Pdf;

class KasirController extends Controller
{
    public function preview($id)
    {
        $invoice = Kasir::find($id);
        return view('invoice.index',compact('invoice'));
    }

    public function download($id)
    {
        $invoice = Kasir::find($id);
        $pdf = Pdf::loadView('invoice.index',
        [
            'invoice' => $invoice
        ]);
        return $pdf->download('invoice.pdf');
    }

}
