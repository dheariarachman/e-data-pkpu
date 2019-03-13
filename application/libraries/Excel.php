<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel {


    public static function setExcelTitle($titleArray = array())
    {
        $array = array();
        foreach ($titleArray as $key => $value) {
            $array[self::$_alphabet[$key] . 1] = $value;
        }
        return $array;
    }

    public static function setExcelValue($valueArray = array(), $fieldDatabase = array())
    {
        $array = array();

    }

    public static function exportExcel($title = '', $dataTitle = array(), $dataQuery = array())
    {
        $col = 2;
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()
            ->setTitle('Sheet 1');
        

        // Set Title
        foreach ($dataTitle as $key => $value) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($key, $value);
        }        

        // Set Value
        foreach ($dataQuery as $key => $value) {
            foreach ($value as $keyVal => $valueVal) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($keyVal . $col, $valueVal);
            }
            $col++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
        header('Cache-Control: max-age=1');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}