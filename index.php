<?php
// Database connection
$host = "mysql"; // Your database host
$username = "username"; // Your database username
$password = "password"; // Your database password
$database = "blog"; // Your database name

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create post
if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    mysqli_query($conn, $sql);
}

// Read posts
$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);

// Update post
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Delete post
if(isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM posts WHERE id=$id";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
</head>
<body>
    <h1>Simple Blog</h1>

    <h2>Create Post</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Title">
        <textarea name="content" placeholder="Content"></textarea>
        <button type="submit" name="submit">Submit</button>
    </form>

    <h2>Posts</h2>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div>
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['content']; ?></p>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="title" value="<?php echo $row['title']; ?>">
                <textarea name="content"><?php echo $row['content']; ?></textarea>
                <button type="submit" name="update">Update</button>
                <button type="submit" name="delete">Delete</button>
            </form>
        </div>
    <?php } ?>

</body>
</html>

<?php mysqli_close($conn); ?>