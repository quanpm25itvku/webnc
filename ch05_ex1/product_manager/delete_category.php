<?php
require_once('../model/database.php');

$category_id = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);

if ($category_id != NULL && $category_id != FALSE) {
    $query = 'DELETE FROM categories
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

header('Location: category_list.php');
exit();
?>