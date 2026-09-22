<?php
require_once('database.php');

// Get form data
$category_id = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
$category_name = filter_input(INPUT_POST, 'categoryName');

if ($category_name !== null) {
    $category_name = trim($category_name);
}

// Validate inputs
if ($category_id == NULL || $category_id == FALSE || empty($category_name)) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
    exit();
} else {
    // Update the database
    $query = 'UPDATE categories
              SET categoryName = :category_name
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $category_name);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to Category List
    header('Location: category_list.php');
    exit();
}
?>