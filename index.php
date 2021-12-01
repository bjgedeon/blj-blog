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
    if (!empty($_POST['post-title'])) {
        $postTitle = $_POST['post-title'];
    } else {
        $errors[] = 'Geben Sie bitte einen Titel ein';
    }
    if (!empty($_POST['post-text'])) {
        $postText = $_POST['post-text'];
    } else {
        $errors[] = 'Geben Sie bitte einen Text ein';
    }
    if (!empty($_POST['post-image'])) {
        $postImage = $_POST['post-image'];
    } else {
        $postImage = '';
    }

    /*echo $postImage;*/
 
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `posts` (created_by, created_at, post_title, post_text, post_image) VALUES (:username, now(), :postTitle, :postText, :postImage)");
        $stmt -> execute([':username' => $username, ':postTitle' => $postTitle, ':postText' => $postText, ':postImage' => $postImage]);
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
<header class = "header">
    <h1 class = "title">Blog</h1>
</header>
<aside class = "asidemain">

<a class = "links2" href = "home.php">Home</a> 
    <a class = "links2" href = "index.php">Blog</a>
<a class = "links2" href = "andereblogs.php">andere Blogs</a>

    </aside>
    <?php if (count($errors) > 0) { ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
<form class = "asideformular" method="post" action="index.php">
    <h2>Schreibe deinen Beitrag</h2>
     Benutzername: <input class = "formular" type = "text" name = "username"> 
     Titel: <input class = "formular" type = "text" name = "post-title"> 
     Bild: <input class = "formular" type = "text" name = "post-image" placeholder="URL des Bildes">
    Text: <textarea class = "block" name = "post-text" rows = "5" cols = "40" placeholder="Schreibe deinen Text"></textarea> 
    <input class = "bottom" type = "submit">
</form>

    <?php
foreach($blogs as $blog)  { ?>

<div class = "asidebeitrag">
<h2 class = "beitragteil">Benutzername:</h2>
    <p><?= htmlspecialchars($blog['created_by'])?></p>
    <h2 class = "beitragteil">Erstelldatum:</h2>
    <p><?= htmlspecialchars($blog['created_at'])?></p>
    <h2 class = "beitragteil">Titel:</h2>
    <p><?= htmlspecialchars($blog['post_title'])?></p>
    <h2 class = "beitragteil">Beitrag:</h2>
    <p><?= htmlspecialchars($blog['post_text'])?></p>

    <?php if (strlen($blog['post_image'] > 4)) { ?>
        <img class = "image" src = <?= htmlspecialchars($blog['post_image'])?> widht="150", height="175"> <?php }
    ?>
</div>
<?php
}
?>
</body>
</html>