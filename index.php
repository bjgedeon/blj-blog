<?php
$user = 'root';
$password = '';
$database = 'blog';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);


date_default_timezone_set('Europe/Zurich');
$postDateTime = date("d.m.Y h:i", time());
$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $errors[] = 'Geben Sie bitte einen Benutzernamen ein';
    }
    if (!empty($_POST['post-text'])) {
        $postText = $_POST['post-text'];
    } else {
        $errors[] = 'Geben Sie bitte einen Text ein';
    }
    if (!empty($_POST['post-title'])) {
        $postTitle = $_POST['post-title'];
    } else {
        $errors[] = 'Geben Sie bitte einen Titel ein';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `posts` (created_by, created_at, post_title, post_text) VALUES (:username, now(), :postTitle, :postText)");
        $stmt -> execute([':username' => $username, ':postTitle' => $postTitle, ':postText' => $postText]);
    }
}

$stmt = $pdo->query('SELECT * FROM `posts`');
$blogs = $stmt->fetchALL(); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
    <title>Blog</title>
</head>
<body class = "grid">
<header>
    <h1 class = "title">Blog</h1>
</header>
<form class = "aside" method="post" action="index.php">


     Benutzername: <input class = "formular" type = "text" name = "username"> <br>
     Titel: <input class = "formular" type = "text" name = "post-title">
     Bild: <input class = "formular" type = "text" name = "image-url" placeholder="URL des Bildes">
    <textarea class = "block" name = "post-text" rows = "5" cols = "40" placeholder="Schreiben Sie ihren Beitrag"></textarea> 
    <input type = "submit">


</form>
<aside class = "aside">
<a href = "andereblogs.php">andere Blogs</a>
    </aside>
    <?php
foreach($blogs as $blog)  { ?>

<div class = "aside">
<h2>Blogger</h2>
<p>Benutzername:</p>
    <h2><?= htmlspecialchars($blog['created_by'])?></h2>
    <p>Erstelldatum:</p>
    <p><?= htmlspecialchars($blog['created_at'])?></p>
    <p>Titel:</p>
    <h2><?= htmlspecialchars($blog['post_title'])?></h2>
    <p>Beitrag:</p>
    <p><?= htmlspecialchars($blog['post_text'])?></p>
</div>
<?php
}
?>
</body>
</html>