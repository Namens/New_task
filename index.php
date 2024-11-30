<?php
    include 'access/function.php';

    $category = ' ';
    $min_price = ' ';
    $max_price = ' ';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $min_price = isset($_POST['min_price']) ? $_POST['min_price'] : '';
        $max_price = isset($_POST['max_price']) ? $_POST['max_price'] : '';
    }

    $sql = "SELECT * FROM products WHERE 1=1";

    if ($category) {
        $sql .= " AND category = '" . mysqli_real_escape_string($_SERVER['link'], $category) . "'";
    }

    if ($min_price !== '') {
        $sql .= " AND price >= " . floatval($min_price);
    }

    if ($max_price !== '') {
        $sql .= " AND price <= " . floatval($max_price);
    }

    $result = mysqli_query($_SERVER['link'], $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фильтр</title>
<body>
    <h1>Фильтр</h1>
    <form method="post" action="">
        <label for="category">Категория:</label>
        <select name="category" id="category">
            <option value="">Все</option>
            <option value="Clothes" <?php if ($category == 'Clothes') echo 'selected'; ?>>Одежда</option>
            <option value="Furniture" <?php if ($category == 'Furniture') echo 'selected'; ?>>Мебель</option>
        </select><br><br>
        
        <label for="min_price">Минимальная цена:</label>
        <input type="number" name="min_price" id="min_price" step="1" value="<?php echo htmlspecialchars($min_price); ?>"><br><br>
        
        <label for="max_price">Максимальная цена:</label>
        <input type="number" name="max_price" id="max_price" step="1" value="<?php echo htmlspecialchars($max_price); ?>"><br><br>
        
        <button type="submit">Фильтровать</button>
    </form>

    <h2>Товары</h2>
    <ul>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li> Название: " . htmlspecialchars($row['name']) . " *** Категория: " . htmlspecialchars($row['category']) . " *** Цена: " . htmlspecialchars($row['price']) . " руб.</li>";
            }
        } else {
            echo "<li>Нет таких товаров.</li>";
        }
        ?>
    </ul>

</body>
</html>
