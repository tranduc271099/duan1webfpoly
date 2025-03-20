<!-- app/views/admin/categories/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Danh Mục</title>
</head>

<body>

    <h2>Thêm Danh Mục</h2>
    <form action="index.php?page=create_category" method="POST">
        <label for="name">Tên Danh Mục</label>
        <input type="text" id="name" name="name" required><br><br>

        <button type="submit">Thêm Danh Mục</button>
    </form>

</body>

</html>