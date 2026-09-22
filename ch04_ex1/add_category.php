<?php
// Get the category data
$categoryName = filter_input(INPUT_POST, 'categoryName');

// Validate inputs
if ($categoryName == null || $categoryName == false) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the category to the database
    $query = 'INSERT INTO categories (categoryName)
              VALUES (:categoryName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryName', $categoryName);
    $statement->execute();
    $statement->closeCursor();

    // Display the Category List page (Dùng header chuyển hướng hoặc include file danh sách)
    header('Location: category_list.php');
}
?>