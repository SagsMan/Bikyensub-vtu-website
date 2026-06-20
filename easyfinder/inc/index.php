<?php
// Initialize session and config
require_once 'user_session.inc.php';

header('Content-Type: application/json');

// DEBUG: Log raw input and POST
error_log("=== inc/index.php START ===");
error_log("METHOD: " . $_SERVER['REQUEST_METHOD']);
error_log("RAW INPUT: " . file_get_contents('php://input'));
error_log("POST initially: " . json_encode($_POST));

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    error_log("Invalid method: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Parse JSON body if Content-Type is application/json
$contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (strpos($contentType, 'application/json') !== false) {
    $jsonInput = json_decode(file_get_contents('php://input'), true);
    if ($jsonInput) {
        $_POST = array_merge($_POST, $jsonInput);
        error_log("POST after JSON merge: " . json_encode($_POST));
    } else {
        error_log("Failed to decode JSON input");
    }
}

// Check if action parameter exists
if (!isset($_POST['action']) && !isset($_POST['action_type'])) {
    echo json_encode(['success' => false, 'message' => 'Action parameter missing.']);
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : $_POST['action_type'];

try {
    error_log("=== inc/index.php: Action received: " . $action . " ===");
    switch ($action) {
        // BVN Validations
        case 'validate_bvn':
            $VerificationController->verifyBvn($_POST);
            break;
            
        case 'advance_validate_bvn':
            $VerificationController->verifyAdvanceBvn($_POST);
            break;
            
        // NIN Slip Validations
        case 'basic_nin_slip':
            $_POST['type'] = 'Basic NIN Slip';
            $VerificationController->submitNINDetail($_POST);
            break;
            
        case 'regular_nin_slip':
            $_POST['type'] = 'Regular NIN Slip';
            $VerificationController->submitNINRegularDetail($_POST);
            break;
            
        case 'improved_nin_slip':
            $_POST['type'] = 'Improved NIN Slip';
            $VerificationController->submitNINImprovedDetail($_POST);
            break;
            
        case 'virtual_nin_slip':
            $_POST['type'] = 'Virtual NIN Slip';
            $VerificationController->submitVirtualNINDetail($_POST);
            break;

        case 'premium_nin_slip':
            $_POST['type'] = 'Premium NIN Slip';
            $VerificationController->submitNINPremiumDetail($_POST);
            break;

        case 'phone_search_verification':
            $_POST['type'] = 'Phone Search Slip';
            $VerificationController->submitPhoneNumberSearch($_POST);
            break;

        // Custom validation actions that are sent by the frontend 
        // These might not be directly in VerificationController but often map to submitNINValidation
        case 'validate_nin':
            // Route to Nin Validation method
            if (method_exists($VerificationController, 'submitNINValidation')) {
                $VerificationController->submitNINValidation($_POST);
            } else {
                echo json_encode(['success' => false, 'message' => 'NIN validation not implemented yet.']);
            }
            break;

        case 'nin_personalization':
            if (method_exists($VerificationController, 'submitNINPersonalization')) {
                $VerificationController->submitNINPersonalization($_POST);
            } else {
                echo json_encode(['success' => false, 'message' => 'NIN Personalization not implemented yet.']);
            }
            break;

        case 'ipe_clearing':
            if (method_exists($VerificationController, 'submitIPEClearing')) {
                $VerificationController->submitIPEClearing($_POST);
            } else {
                echo json_encode(['success' => false, 'message' => 'IPE Clearing not implemented yet.']);
            }
            break;

        case 'nin_modification':
            if (method_exists($VerificationController, 'submitNINModification')) {
                $VerificationController->submitNINModification($_POST, $_FILES);
            } else {
                echo json_encode(['success' => false, 'message' => 'NIN Modification not implemented yet.']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Unknown action requested: ' . $action]);
            break;
    }
} catch (Exception $e) {
    error_log("EXCEPTON in inc/index.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Internal Server Error: ' . $e->getMessage()]);
}

error_log("=== inc/index.php END ===");
