<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceExport implements FromView
{
    public function view(): View
    {
        return view('download.invoice', [
            'invoices' => Invoice::all()
        ]);
    }
}
