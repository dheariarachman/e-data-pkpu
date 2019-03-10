<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel {

    public static function createExcel($title = '')
    {
        // Initialize Spreadsheet
        $spreadsheet    = new Spreadsheet();

        // Creator
        $spreadsheet->getProperties()
            ->setCreator('E-Data2 ( Dhea Aria Rachman - dheariarachman@gmail.com )')
            ->setLastModifiedBy('E-Data2 ( Dhea Aria Rachman - dheariarachman@gmail.com )')
            ->setTitle($title)
            ->setCategory('Daftar Nasabah');

        // Add Data

        $sheet          = $spreadsheet->getActiveSheet();

        // $sheet->setCellValue('A1', 'Hello World');

        // $writer         = new Xlsx($spreadsheet);
        // $writer->save('FileName.xlsx');
    }

}