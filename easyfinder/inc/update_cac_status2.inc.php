<?php
 

require_once 'user_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $success = [];

    // Retrieve POST data
    $requestId = isset($_POST['request_id']) ? trim($_POST['request_id']) : null;
    $status = isset($_POST['cacstatus']) ? trim($_POST['cacstatus']) : null;
    $cacDocPath = null;

    // Validate the input data
    if (empty($requestId)) {
        $errors[] = 'Request ID is required.';
    } elseif (!is_numeric($requestId) || $requestId <= 0) {
        $errors[] = 'Invalid Request ID.';
    }

    if ($status === null) {
        $errors[] = 'Status is required.';
    } elseif (!in_array($status, ['0', '1', '2', '3'], true)) {
        $errors[] = 'Invalid status value.';
    }

    // Handle file upload if a file was uploaded
    if (isset($_FILES['cac_doc']) && $_FILES['cac_doc']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '/path/to/upload/directory/'; // Update this path as necessary
        $fileName = basename($_FILES['cac_doc']['name']);
        $cacDocPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['cac_doc']['tmp_name'], $cacDocPath)) {
            $errors[] = 'Failed to upload file.';
        }
    }

    // Check for any errors before processing
    if (empty($errors)) {
        // Update CAC request status and document path
        if ($AdminTask->updateCACRequestStatus2($requestId, (int)$status, $cacDocPath)) {
            $success[] = 'CAC status updated successfully!';
        } else {
            $errors[] = 'Failed to update CAC status. Please try again.';
        }
    }

    // Prepare the response
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'messages' => $errors]);
    } else {
        echo json_encode(['success' => true, 'messages' => $success]);
    }
} else {
    // Handle case where the request method is not POST
    echo json_encode(['success' => false, 'messages' => ['Invalid request method.']]);
}
