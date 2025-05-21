<?php
require_once '../db/connection.php';

$data = json_decode(file_get_contents("php://input"), true);

$ticket_code = strtoupper(uniqid("TICKET_")); // Generate unique ticket code
$holder_name = $data['holder_name'];
$ticket_type = $data['ticket_type']; // e.g. Regular, VIP, Guest
$created_by = $data['created_by']; // user id from session/login

try {
    $stmt = $conn->prepare("INSERT INTO tickets (ticket_code, holder_name, ticket_type, created_by) VALUES (?, ?, ?, ?)");
    $stmt->execute([$ticket_code, $holder_name, $ticket_type, $created_by]);

    echo json_encode([
        "message" => "Ticket created successfully.",
        "ticket" => [
            "ticket_code" => $ticket_code,
            "holder_name" => $holder_name,
            "ticket_type" => $ticket_type
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Ticket creation failed: " . $e->getMessage()]);
}
?>
