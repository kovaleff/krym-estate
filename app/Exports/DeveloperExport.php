<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class DeveloperExport implements FromCollection
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    public function headings() :array
    {
        return [
            'title',
            'content',
            'founded',
            'founded',
            'siteurl',
            'image',
        ];
    }
}
