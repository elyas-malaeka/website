<?php
/**
 * Database Connection
 * This file handles the connection to the database for the Student Registration Form
 */

// Database configuration
$db_host = 'localhost';
$db_name = 'student_registration_db';
$db_user = 'root';      // Change to your database username
$db_pass = '';          // Change to your database password

// Character encoding
$charset = 'utf8mb4';

// DSN (Data Source Name)
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Create a PDO instance (connect to the database)
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // If connection fails, log error to file and show a user-friendly message
    error_log('Database Connection Error: ' . $e->getMessage(), 0);
    die('A database connection error occurred. Please try again later or contact support.');
}

/**
 * Execute a query with parameters
 * 
 * @param PDO $pdo PDO instance
 * @param string $sql SQL query with placeholders
 * @param array $params Parameters to bind to the query
 * @return PDOStatement The executed statement
 */
function executeQuery($pdo, $sql, $params = []) {
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log('Database Query Error: ' . $e->getMessage(), 0);
        die('An error occurred while processing your request. Please try again later.');
    }
}

/**
 * Get the last inserted ID
 * 
 * @param PDO $pdo PDO instance
 * @return string The last inserted ID
 */
function getLastInsertId($pdo) {
    return $pdo->lastInsertId();
}

/**
 * Begin a transaction
 * 
 * @param PDO $pdo PDO instance
 */
function beginTransaction($pdo) {
    $pdo->beginTransaction();
}

/**
 * Commit a transaction
 * 
 * @param PDO $pdo PDO instance
 */
function commitTransaction($pdo) {
    $pdo->commit();
}

/**
 * Rollback a transaction
 * 
 * @param PDO $pdo PDO instance
 */
function rollbackTransaction($pdo) {
    $pdo->rollBack();
}

/**
 * Log database activity
 * 
 * @param PDO $pdo PDO instance
 * @param string $action The action being performed
 * @param string $description Description of the action
 * @param int $userId User ID (if available)
 */
function logActivity($pdo, $action, $description = '', $userId = null) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    
    $sql = "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?)";
    
    executeQuery($pdo, $sql, [$userId, $action, $description, $ip, $userAgent]);
}