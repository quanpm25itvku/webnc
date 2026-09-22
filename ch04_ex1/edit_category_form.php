<?php
require_once('database.php');

// Get category ID from GET request
$category_id = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);

if ($category_id == NULL || $category_id == FALSE) {
    $error = "Invalid category ID.";
    include('error.php');
    exit();
}

// Fetch current category details
$query = 'SELECT * FROM categories WHERE categoryID = :category_id';
$statement = $db->prepare($query);
$statement->bindValue(':category_id', $category_id);
$statement->execute();
$category = $statement->fetch();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<header><h1>Product Manager</h1></header>
<main>
    <h1>Edit Category</h1>
    <form action="update_category.php" method="post" id="add_category_form">
        <!-- Hidden input for categoryID -->
        <input type="hidden" name="categoryID" value="<?php echo htmlspecialchars($category['categoryID']); ?>">

        <label>Name:</label>
        <input type="text" name="categoryName" value="<?php echo htmlspecialchars($category['categoryName']); ?>" required><br>

        <label>&nbsp;</label>
        <input type="submit" value="Save Changes"><br>
    </form>
    <br>
    <p><a href="category_list.php">List Categories</a></p>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>