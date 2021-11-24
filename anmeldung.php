<?php
$user = 'root';
$password = '';
$database = 'blog';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$stmt = $pdo->prepare('SELECT * FROM `blog`');
$stmt->fetchAll()

date_default_timezone_set('Europe/Zürich');
$postDateTime = date("d.m.Y h:i", time());
$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $errors[] = 'Bitte geben Sie eien Benutzernamen ein';
    }
    if (!empty($_POST['post-text'])) {
        $username = $_POST['post-text'];
    } else {
        $errors[] = 'Geben Sie bitte einen Text ein';
    }
    if (!empty($_POST['post-title'])) {
        $username = $_POST['post-title'];
    } else {
        $errors[] = 'Geben Sie bitte einen Titel ein';
    }
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `posts` (created_by, created_at, post_title, post_text) VALUES (:username, :postTime, :postTitle, :postText)");

    }
}

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
    <title>Beitrag</title>
</head>
<body class = "grid">
<header>
    <h1 class = "title">Beitrag</h1>
</header>
<aside class = "aside">
    <a href = "index.php">Blog</a>
</aside>
<main class = "aside">
<div>

     Nutzername: <input class = "formular" type = "text" name = "name"> <br>
     Titel: <input class = "formular" type = "text" name = "name">
    <textarea class = "block" name = "beitrag" rows = "5" cols = "40" placeholder="Schreiben Sie ihren Beitrag"></textarea> 


</div>
</main>
</body>
</html>