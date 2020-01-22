<?php
require_once 'db_connection.php';
var_dump($_GET);
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM Books.books b LEFT JOIN book_authors ba ON ba.book_id = b.id
LEFT JOIN authors a ON ba.author_id = a.id WHERE b.id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $book['title']; ?></title>
</head>
<body>
<br> 
<h3>Raamatu pealkiri</h3>
<form action="edit.php" method="get">
        <input type="hidden" name="id" value='<?php echo $id?>'>
        <input type='text' name='title' value='<?php echo $book['title']; ?>'>
        <br>

<?php echo $book['title']; ?>  
<br>
<h3>Laos hetkel</h3>
       
        <input type='text' name='stock' value='<?php echo $book['stock_saldo']; ?>'>
        <br>

    <h3>Lehekülgi</h3>

       
        <input type='text' name='page' value='<?php echo $book['pages']; ?>'>
        <br>
    <h3>Keel</h3>
       
        <input type='text' name='language' value='<?php echo $book['language']; ?>'>
        <br>
    <h3>Autori nimi</h3>
       
        <input type='text' name='names' value='<?=$book['first_name']?> <?=$book['last_name']?>'>
        <br>
        <br>
        <input type='submit' value='Salvesta'>
    </form>

</body>
</html>