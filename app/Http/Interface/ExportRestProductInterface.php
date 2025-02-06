<?php
namespace App\Http\Interface;


interface ExportRestProductInterface{
    public function checkExportStatus();
    public function export($request);
}