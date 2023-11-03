<?php

namespace App\Services\PDF;
use PDF;

class ConvertDataToPDF
{
    protected $ViewName;
    protected $Data;
    protected $FileName;
    public function __construct($ViewName ,$Data,$FileName)
    {
         $this->ViewName = $ViewName;
         $this->Data = $Data;
         $this->FileName = $FileName;
         $this->ToPDFFile();
    }

    private function ToPDFFile(){
        $pdf = PDF::Make();
         $data = [
           'allData'=>$this->Data
         ];
        $pdf->loadView($this->ViewName, $data);
        return $pdf->stream( $this->FileName);
    }



}
