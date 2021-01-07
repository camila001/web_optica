<?php

namespace controllers;

use models\Receta as Receta;

require_once("../models/Receta.php");
require_once("tcpdf_include.php");

class ExportarPDF{
    public $id;

    public function __construct()
    {
        $this->id = $_GET['id'];
    }

    public function generarPDF(){
        $model = new Receta();
        $arr = $model->buscarxId($this->id);
        $receta = $arr[0];

        //Llamar a la libreria 

        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Optica-2020');
        $pdf->SetTitle('Reporte de Receta '.$receta['id']);
        $pdf->SetSubject('Optica Talca');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Optilazer Talca', 'Receta de '.$receta['nombre_cliente'], array(0,0,0), array(255,61,19));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $id = $receta['id'];
        $cliente = $receta['nombre_cliente'];
        $telefono = $receta['telefono_cliente'];
        $entrega = $receta['fecha_entrega'];
        $vendedor= $receta['nombre_vendedor'];
        $tipolente = $receta['tipo_lente'];
        $tipocristal =$receta['tipo_cristal'];
        $armazon = $receta['armazon'];
        $distancia = $receta['distancia_pupilar'];
        $material = $receta['material_cristal'];
        $prisma = $receta['prisma'];
        $base = $receta['base'];
        $eoi = $receta['esfera_oi'];
        $eod = $receta['esfera_od'];
        $coi = $receta['cilindro_oi'];
        $cod = $receta['cilindro_od'];
        $ejoi = $receta['eje_oi'];
        $ejod = $receta['eje_od'];
        $obs = $receta['observacion'];
        $valor = $receta['precio'];
        $html = <<<EOD
        <h2>Reporte de Receta ID: $id </h2>
        
        <hr style="height:3px; border:none; background: #ff4500; margin-bottom:20px;">
        <p></p>
        <p><span style="font-weight: bold;">Nombre cliente:</span> $cliente</p>
        <p><span style="font-weight: bold;">Telefono cliente:</span> $telefono</p>
        <p><span style="font-weight: bold;">Fecha de entrega:</span> $entrega</p>
        <p><span style="font-weight: bold;">Atendido por:</span> $vendedor</p>

        <hr style="height:3px; border:none; background: #dd2c00; margin-bottom:20px;">
        <p></p>
        <p><span style="font-weight: bold;">Tipo de lente:</span> $tipolente</p>
        <p><span style="font-weight: bold;">Tipo de cristal:</span> $tipocristal</p>
        <p><span style="font-weight: bold;">Armazon:</span> $armazon</p>
        <p><span style="font-weight: bold;">Distancia pupilar:</span> $distancia</p>
        <p><span style="font-weight: bold;">Material del cristal:</span> $material</p>
        <p><span style="font-weight: bold;">Prisma:</span> $prisma</p>
        <p><span style="font-weight: bold;">Base:</span> $base</p>

        <hr style="height:3px; border:none; background: #dd2c00; margin-bottom:20px;">
        <p></p>
        <table>
            <tr>
                <th></th>
                <th>Ojo izquierdo</th>
                <th>Ojo derecho</th>
            </tr>
            <tr>
                <td style="font-weight: bold;">Esfera</td>
                <td>$eoi</td>
                <td>$eod</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Cilindro</td>
                <td>$coi</td>
                <td>$cod</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Eje</td>
                <td>$ejoi</td>
                <td>$ejod</td>
            </tr>
        </table>
        <p></p>    
        <hr style="height:3px; border:none; background: #dd2c00; margin-bottom:20px;">
        <p></p> 
        <table>
            <tr>
                <th><p style="font-weight:bold;">Observaciones</p></th>
                <th><p style="font-weight:bold;">Valor</p>   </th>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>$obs</td>
                <td>$ $valor</td>
            </tr>
        </table>

        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('receta.pdf', 'I');


    }

}
$obj = new ExportarPDF();
$obj->generarPDF();