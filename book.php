<?php
require_once 'db_connection.php';
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM Books.books LEFT JOIN Books.book_authors ON book_id=Books.books.id LEFT JOIN Books.authors ON Books.authors.id = author_id WHERE Books.books.id=:id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$book['title'] ?>  </title>
</head>
<body>
<a href="delete.php?id=<?php echo $id?>">Delete </a>  <br><br>
<a href="edit.php?id=<?php echo $id?>">Edit </a>  
<h1>Kirjeldus: </h1>
<?=$book['summary']?> <br>
<h2>Laos hetkel: </h2>
<?=$book['stock_saldo']?> <br>
<h2>Lehekülgi: </h2>
<?=$book['pages']?> <br>
<h2>Ilmumisaasta: </h2>
<?=$book['release_date']?> <br> 
<h2>Keel: </h2>
<?=$book['language']?> <br>
<h2>Autori nimi </h2>
<?=$book['first_name']?> <?=$book['last_name']?>


</body>
</html>