<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class thuocexport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        $all_product = $this->data;
        
        return view('admin.exportthuoc', compact('all_product'));
    }
}
