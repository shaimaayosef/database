<?php

// Enable error reporting for PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "scandiAdmin";
$password = "1234";
$dbname = "scandi4ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create categories table
$sql = "CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating categories table: " . $conn->error . "<br>";
}

// Create products table
$sql = "CREATE TABLE IF NOT EXISTS products (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    inStock BOOLEAN,
    stock INTEGER,
    description TEXT,
    category VARCHAR(255),
    brand VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating products table: " . $conn->error . "<br>";
}

// Create product_gallery table
$sql = "CREATE TABLE IF NOT EXISTS product_gallery (
    product_id VARCHAR(255),
    image_url TEXT,
    FOREIGN KEY (product_id) REFERENCES products(id)
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating product_gallery table: " . $conn->error . "<br>";
}

// Create product_attributes table
$sql = "CREATE TABLE IF NOT EXISTS product_attributes (
    id VARCHAR(255),
    product_id VARCHAR(255),
    attribute_name VARCHAR(255),
    attribute_type VARCHAR(255),
    FOREIGN KEY (product_id) REFERENCES products(id)
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating product_attributes table: " . $conn->error . "<br>";
}

// Create product_attribute_items table
$sql = "CREATE TABLE IF NOT EXISTS product_attribute_items (
    product_id VARCHAR(255),
    attribute_name VARCHAR(255),
    display_value VARCHAR(255),
    value VARCHAR(255),
    item_id VARCHAR(255),
    FOREIGN KEY (product_id) REFERENCES products(id)
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating product_attribute_items table: " . $conn->error . "<br>";
}

// Create product_prices table
$sql = "CREATE TABLE IF NOT EXISTS product_prices (
    product_id VARCHAR(255),
    amount DECIMAL(10, 2),
    currency_label VARCHAR(10),
    currency_symbol VARCHAR(10),
    FOREIGN KEY (product_id) REFERENCES products(id)
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating product_prices table: " . $conn->error . "<br>";
}

// Create orders table
$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating orders table: " . $conn->error . "<br>";
}

// Create order_products table
$sql = "CREATE TABLE IF NOT EXISTS order_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id VARCHAR(255) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id)
)";
if ($conn->query($sql) === FALSE) {
    echo "Error creating order_products table: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();
?>
