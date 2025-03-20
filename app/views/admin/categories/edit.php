<!-- app/views/admin/categories/edit.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Danh Mục</title>
</head>

<body>

    <h2>Sửa Danh Mục</h2>
    <form action="index.php?page=edit_category&id=<?php echo $category['id']; ?>" method="POST">
        <label for="name">Tên Danh Mục</label>
        <input type="text" id="name" name="name" value="<?php echo $category['name']; ?>" required><br><br>

        <button type="submit">Cập Nhật</button>
    </form>

</body>

</html>