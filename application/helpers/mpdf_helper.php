<?php

class mpdf
{
    public static function print_pdf( $html = '', $orientation = 'P') {
        $mpdf = new \Mpdf\Mpdf(array('orientation' => $orientation));
        $mpdf->writeHTMLHeaders('E-Data - v1');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
