<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class ExportToExcelSheet implements FromView
{
    protected $data;
    protected $viewName;
  public function __construct($data,$viewName){
      $this->data = $data;
      $this->viewName = $viewName;
  }

    public function view(): View
    {
        return view($this->viewName, [
            'allData' => $this->data
        ]);

}
}
