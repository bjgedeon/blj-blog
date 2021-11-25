<?php
$user = 'root';
$password = '';
$database = 'blog';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$stmt = $pdo->query('SELECT * FROM `posts`');
$blogs = $stmt->fetchALL(); 

session_start();
$imagesString = '';
$imagesArray = array();
date_default_timezone_set('Europe/Zurich');
$postDateTime = date("d.m.Y H:i:s", time());
$errors = array();

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
<aside class = "aside">
<a href = "anmeldung.php">Beitrag schreiben</a>
<a href = "andereblogs.php">andere Blogs</a>
    </aside>
    <main class = "aside">
    <h2>Blogger</h2>
    <p>Benutzername:</p>
    <p>Erstelldatum: </p>
    <p>Beitrag: </p>
    </main>
 
</body>
</html>