<?php
/*
Documentation link mpdf::  https://packagist.org/packages/mpdf/mpdf
Version support::
PHP 7.3 is supported since mPDF v7.1.7
PHP 7.4 is supported since mPDF v8.0.4
PHP 8.0 is supported since mPDF v8.0.10
PHP 8.1 is supported as of mPDF v8.0.13
PHP 8.2 is supported as of mPDF v8.1.3
PHP 8.3 is supported as of mPDF v8.2.1
PHP 8.4 is supported as of mPDF v8.2.5
*/
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts']),
    'fontdata' => $fontData + [
        'solaimanlipi' => [
            'R' => 'SolaimanLipi.ttf',
        ]
    ],
    'default_font' => 'solaimanlipi'
]);

$html = '
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8" />
    <style>
        body { font-family: solaimanlipi, sans-serif; font-size: 14pt; }
        h1 { color: #007BFF; }
    </style>
</head>
<body>
    <h1>স্বাগতম! বাংলা PDF তৈরী করা হলো।</h1>
    <p>এই পিডিএফটি SolaimanLipi ফন্ট ব্যবহার করেছে, তাই বাংলা সুন্দর দেখাচ্ছে। 😊</p>
</body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output('bangla_pdf.pdf', 'D');