<?php

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

require_once '../inc/user_session.inc.php';

try {

    $writer = new PngWriter();

    // Create QR code
    $qrCode = new QrCode(
        data: json_encode(['name' => 'Umar', 'value' =>'ssssssssssssssssssssss']),
        encoding: new Encoding('UTF-8'),
        errorCorrectionLevel: ErrorCorrectionLevel::Low,
        size: 300,
        margin: 10,
        roundBlockSizeMode: RoundBlockSizeMode::Margin,
        foregroundColor: new Color(0, 0, 0),
        backgroundColor: new Color(255, 255, 255)
    );

    $result = $writer->write($qrCode);

    // Validate the result
    // $writer->validateResult($result, 'Life is too short to be generating QR codes');

    // Directly output the QR code
    header('Content-Type: '.$result->getMimeType());
    echo $result->getString();

    // Save it to a file
    $result->saveToFile('qrcode.png');

    // Generate a data URI to include image data inline (i.e. inside an <img> tag)
    echo $dataUri = $result->getDataUri();
} catch (Exception $e) {
    echo $e->getMessage();
}