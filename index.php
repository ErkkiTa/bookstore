<?php
$host = '127.0.0.1';
$db   = 'Books';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
//var_dump($_GET);
$title = $_GET['title'];
$year = $_GET['year'];
$stmt = $pdo->prepare('SELECT * FROM books WHERE title LIKE :title AND release_date =:year');
$stmt->execute(['title' => '%' . $title . '%' ,'year'=> $year]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raamatu otsng</title>
</head>
    <style>
        h1 { color: #ff00ae; }
    </style>
<body>

    <h1> Otsinguriba </h1>
    
    </form>
    
    
    <form action="index.php" method="GET">
        <input id="otsing" name="title" type="text" placeholder="Raamatu nimi" value="<?=$title;?>">
        <input id="otsing" name="year" type="text" placeholder="Raamatu väljalaske auto" value="<?=$year;?>">
        <input id="submit" type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #ffffff ; background-color: #ff00ae"  value="Search" class="button"/>
    </form>
    <ul>
<?php
while ($row = $stmt->fetch())
{
    echo '<li>' .$row['title'] . "
    <br>
    <br>";
}
?>
    </ul>

</body>
</html>
