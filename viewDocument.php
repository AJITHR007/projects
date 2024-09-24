<?php
// Assuming $documentPath is the path to the document file
$documentPath = $_GET['document'];

// Set the appropriate headers for file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($documentPath) . '"');
header('Content-Length: ' . filesize($documentPath));

// Output the file content
readfile($documentPath);
exit;
?>
