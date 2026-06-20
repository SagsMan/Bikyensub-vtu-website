<?php 
session_start();
// Specify the target directory for file uploads
$uploadDir = 'uploads/documents/';

// Check if the request is a POST request and if the file is uploaded successfully
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['companyGovtCertificate']) && $_FILES['companyGovtCertificate']['error'] === UPLOAD_ERR_OK) {

    // Validate file type and size (you can adjust the allowed file types and size limit)
    $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    $fileName = $_FILES['companyGovtCertificate']['name'];
    $fileSize = $_FILES['companyGovtCertificate']['size'];
    $fileTmpName = $_FILES['companyGovtCertificate']['tmp_name'];

    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExtension), $allowedTypes)) {
        echo json_encode(['error' => 'Invalid file type. Allowed types: pdf, jpg, jpeg, png']);
        exit;
    }

    if ($fileSize > $maxFileSize) {
        echo json_encode(['error' => 'File size exceeds the limit of 5 MB']);
        exit;
    }

    // Generate a unique file name to prevent filename conflicts
    $newFileName = uniqid('file_'.$_SESSION['signuflow']['companyId'].'_', true) . '.' . $fileExtension;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($fileTmpName, $uploadDir . $newFileName)) {
        // File uploaded successfully
        echo json_encode(['success' => 'File uploaded successfully', 'filename' => $newFileName]);
    } else {
        // Error in moving the file
        echo json_encode(['error' => 'Error uploading file']);
    }

} else {
    // Invalid request or file upload error
    echo json_encode(['error' => 'Invalid request or file upload error']);
}
?>
