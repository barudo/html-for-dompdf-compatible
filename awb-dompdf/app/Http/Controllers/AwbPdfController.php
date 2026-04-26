<?php

namespace App\Http\Controllers;

use App\Support\AwbSampleData;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class AwbPdfController extends Controller
{
    public function preview(): View
    {
        return view('pdf.awb', [
            'awb' => AwbSampleData::make(),
        ]);
    }

    public function download(): Response
    {
        $pdf = Pdf::loadView('pdf.awb', [
            'awb' => AwbSampleData::make(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('airway-bill.pdf');
    }
}
