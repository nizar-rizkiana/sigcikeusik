<?php

namespace App\Controllers;

use App\Libraries\MY_TCPDF AS TCPDF;
use App\Models\SekolahModel;
use App\Models\JenjangModel;
use App\Models\DesaModel;
use App\Models\AdminModel;

class Dashboard extends BaseController
{
    protected $SekolahModel;
    protected $JenjangModel;
    protected $DesaModel;
    protected $AdminModel;

    public function __construct()
    {
        $this->sekolahModel = new SekolahModel();
        $this->jenjangModel = new JenjangModel();
        $this->desaModel = new DesaModel();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'total_sekolah' => $this->sekolahModel->countAll(),
            'total_jenjang' => $this->jenjangModel->countAll(),
            'total_desa' => $this->desaModel->countAll(),
            'total_admin' => $this->adminModel->countAll(),
            'sekolah'    => $this->sekolahModel->findAll()
        ];
        return view('index', $data);
    }

    public function cetak()
    {

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('nizar rizkiana');
        $pdf->SetTitle('Data Sekolah');
        $pdf->SetSubject('Sig Cikeusik');
        $pdf->SetKeywords('TCPDF, PDF, example, sig');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
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

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage('L', '', 'A4');

       //view mengarah ke hasil-diagnosa.php
       $data = [
           'sekolah' => $this->sekolahModel->getSekolah(),
       ];
        $html = view('laporan', $data);

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('laporan-data-sekolah.pdf', 'I');

    }
}
