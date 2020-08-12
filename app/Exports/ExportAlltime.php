<?php

namespace App\Exports;

use App\Time;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAlltime implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Time::orderBy('created_at', 'desc')->get();
    }
}
