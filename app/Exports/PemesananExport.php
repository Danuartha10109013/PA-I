<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class PemesananExport implements FromView,ShouldAutoSize
{
    protected $data;
    use Exportable;


    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view() : View
    {
        return view('pages.admin.k-pesanan.export', [
            'data' => $this->data
        ]);
    }
}