<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

$fileData = file_get_contents(__DIR__ . '/users.json');
$users    = json_decode($fileData, true);

$html = '';

foreach ($users as $user) {
    $html .= '<div style="margin-bottom: 20px">' . 
             '<b>Name: </b><span style="color: blue">' . $user['name'] . '</span>' .
             '</div>';
}

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$content = $dompdf->output();
file_put_contents(__DIR__ . '/test.pdf', $content);

echo 'Done!';
