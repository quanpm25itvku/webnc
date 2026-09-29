<?php include '../view/header.php';
require('../model/database.php');
$query = 'SELECT * FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
    <main>
        <h1>Category List</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th> <!-- Column for Edit button -->
                <th>&nbsp;</th> <!-- Column for Delete button -->
            </tr>

            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($category['categoryName']); ?></td>

                    <td>
                        <a href="edit_category_form.php?categoryID=<?php echo $category['categoryID']; ?>">Edit</a>
                    </td>

                    <!-- Form Delete -->
                    <td>
                        <form action="delete_category.php" method="post" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            <input type="hidden" name="categoryID" value="<?php echo htmlspecialchars($category['categoryID']); ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Add Category</h2>
        <form action="add_category.php" method="post" id="add_category_form">
            <label>Name:</label>
            <input type="text" name="categoryName" required><br>
            <label>&nbsp;</label>
            <input type="submit" value="Add Category"><br>
        </form>
        <br>
        <p><a href="index.php">List Products</a></p>

    </main>
<?php include '../view/footer.php'; ?>