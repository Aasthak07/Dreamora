<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'dreamora_shop';

// Create connection
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop database if exists
$sql = "DROP DATABASE IF EXISTS `$database`";
if ($conn->query($sql) === TRUE) {
    echo "Database dropped successfully\n";
} else {
    die("Error dropping database: " . $conn->error . "\n");
}

// Create database
$sql = "CREATE DATABASE `$database`";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    die("Error creating database: " . $conn->error . "\n");
}

// Select the database
$conn->select_db($database);

// Read and execute the schema file
$sql = file_get_contents(__DIR__ . '/database/schema.sql');

// Execute multi query
if ($conn->multi_query($sql)) {
    do {
        // Store first result set
        if ($result = $conn->store_result()) {
            $result->free();
        }
        // Prepare next result set
    } while ($conn->more_results() && $conn->next_result());
}

// Check for errors in multi query
if ($error = $conn->error) {
    die("Error executing SQL: " . $error . "\n");
}

echo "Database schema imported successfully!\n";

// Close connection
$conn->close();
?>

<h2>Database Setup Complete!</h2>
<p>The database has been successfully set up with all necessary tables.</p>
<p><a href="index.php">Go to Homepage</a></p>
