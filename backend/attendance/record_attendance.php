<?php
require_once '../db/connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$ticket_code = $data['ticket_code'];

try {
    // Check if the ticket exists
    $stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_code = ?");
    $stmt->execute([$ticket_code]);
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ticket) {
        echo json_encode(["error" => "Ticket not found."]);
        exit;
    }

    // Check if already recorded
    $stmt = $conn->prepare("SELECT * FROM attendance WHERE ticket_code = ?");
    $stmt->execute([$ticket_code]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Attendance already recorded."]);
        exit;
    }

    // Record attendance
    $stmt = $conn->prepare("INSERT INTO attendance (ticket_code, attendance_time) VALUES (?, NOW())");
    $stmt->execute([$ticket_code]);

    echo json_encode([
        "message" => "Attendance recorded successfully.",
        "ticket_code" => $ticket_code,
        "time" => date('Y-m-d H:i:s')
    ]);

} catch (PDOException $e) {
    echo json_encode(["error" => "Error recording attendance: " . $e->getMessage()]);
}
?>
