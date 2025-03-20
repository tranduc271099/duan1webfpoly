<!-- app/views/admin/categories/view.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết danh mục</title>
</head>

<body>
    <h2>Chi tiết danh mục: <?php echo $category['name']; ?></h2>
    <p><strong>ID:</strong> <?php echo $category['id']; ?></p>
    <p><strong>Tên danh mục:</strong> <?php echo $category['name']; ?></p>

    <a href="index.php?page=categories">Quay lại danh sách danh mục</a>
</body>

</html>