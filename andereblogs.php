<?php 
$pdo2 = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_dagomez', 'd041e_dagomez', '54321_Db!!!', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);

$stmt = $pdo2->query('SELECT `url`, `description` FROM `urls`');
$urls = $stmt->fetchALL(); 
array_multisort(array_column($urls, 'description'), SORT_ASC, $urls)
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
    <title>andere Blogs</title>
</head>
<body class = "grid">
    <header class = "header">
    <h1 class = "title">Andere Blogs</h1>
</header>
<aside class = "asidemain">
 <a class = "links2" href = "home.php">Home</a> 
 <a class = "links2" href = "index.php">Blog</a> 
 <a class = "links2" href = "andereblogs.php">andere Blogs</a> 

</aside>
<main class = "aside">

    <ul class = "liste">
        <?php
        foreach ($urls as $url) { ?>
        
<li class = "andereblogs"> <a class = "links3" href=<?=$url['url']?>><?=$url['description']?></a></li>
<?php } ?>

        </ul>

    
</main>
</body>
</html>