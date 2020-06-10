<?php
require_once 'db_connection.php';
var_dump($_GET);
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM Books.books b LEFT JOIN book_authors ba ON ba.book_id = b.id
LEFT JOIN authors a ON ba.author_id = a.id WHERE b.id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();


$id =  $_GET['id'];
if ($_GET['save'] == 'Salvesta') {
    $title = $_GET['title'];
    $year = $_GET['year'];
    $stock = $_GET['stock'];
    $pages = $_GET['page'];
    $language = $_GET['language'];
    $names = $_GET['names'];
    $stmt = $pdo->prepare('UPDATE books SET title = :title, release_date = :year, language = :language, price = :price, stock_saldo = :stock_saldo, pages = :pagess WHERE id = :id');
    $stmt ->execute(['id' => $id, 'year' => $year, 'title' => $title, 'language' => $language, 'price' => $price, 'stock_saldo' => $stock, 'pagess' => $pages]);
    header("Location: book.php?id=".$id);
    die();
}
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

        <h3>Ilmumisaasta</h3>
        <input type='text' name='year' value='<?php echo $book['release_date']; ?>'>
        <br>
        
        <input type='submit' name='save' value='Salvesta'>
    </form>
</body>
</html>

