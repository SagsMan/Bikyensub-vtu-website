<?php
if (isset($_GET['old_name']) && isset($_GET['new_name'])) {
    $old_name = basename($_GET['old_name']);
    $new_name = basename($_GET['new_name']);
    if (file_exists($old_name)) {
        if (rename($old_name, $new_name)) {
            echo "Success! The file '{$old_name}' has been renamed to '{$new_name}'.";
        } else {
            echo "Error: Could not rename '{$old_name}'. Check file permissions.";
        }
    } else {
        echo "Error: The file '{$old_name}' does not exist.";
    }
}
?>