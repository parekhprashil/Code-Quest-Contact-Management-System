<?php
session_start();
include 'conf.php';

$user_id = $_SESSION['user_id'];

$stmt = $con->prepare('SELECT * FROM contactdetails WHERE user_id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

header('Content-Type: text/vcard');
header('Content-Disposition: attachment; filename="contacts.vcf"');

while ($row = $result->fetch_assoc()) {
    echo "BEGIN:VCARD\n";
    echo "VERSION:3.0\n";
    echo "FN:" . $row['contact_name'] . "\n";
    echo "TEL:" . $row['contact_phone_number'] . "\n";
    echo "EMAIL:" . $row['contact_email_id'] . "\n";
    echo "END:VCARD\n";
}
?>