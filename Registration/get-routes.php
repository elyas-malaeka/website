<?php
/**
 * This file retrieves transportation routes from the database based on city
 */

// Include database connection
require_once 'db-connection.php';

// Check if city parameter exists
if (!isset($_POST['city']) || empty($_POST['city'])) {
    echo json_encode([]);
    exit;
}

// Sanitize input
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);

try {
    // Get routes for the selected city
    $sql = "SELECT route_id AS id, CONCAT(route_name, ' - ', description) AS name FROM routes WHERE city = ? ORDER BY route_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$city]);
    
    // Fetch all routes
    $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return routes as JSON
    echo json_encode($routes);
} catch (PDOException $e) {
    // Log the error but return empty array to client
    error_log('Error retrieving routes: ' . $e->getMessage());
    echo json_encode([]);
}