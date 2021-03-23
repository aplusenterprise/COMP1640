<?php
ob_start();
include 'config.php';
include 'include/function.php';
session_start();


// sql to delete a record
if (isset($_GET['commentid'])) {
    
    $commentid = $_GET['commentid'];
    $sql = "DELETE FROM comment WHERE CommentID=".$commentid.";";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Fallback behaviour goes here
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>