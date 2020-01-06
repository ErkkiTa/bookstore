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
    <link rel="style" href="style.css">
    <title>Raamatu otsing</title>
</head>
    <style>
        h1 { color: #6AE3F3; }
    </style>
<body>

    <h1> Otsing </h1>
    <?php
    require_once 'db_connection.php';

    $year = $_GET['year'];
    $title = $_GET['title'];

    ?>
    
    </form>
    
    
    <form action="index.php" method="GET">
        <input id="otsi" name="title" type="text" placeholder="Raamatu pealkiri" value="<?=$title;?>">
        <input id="otsi" name="year" type="text" placeholder="Raamatu aasta" value="<?=$year;?>">  <br> <br>
        <input id="submit" type="submit" value="Otsi" style="box-shadow: 0px 10px 14px -7px #276873;background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);background-color:#599bb3;border-radius:8px;display:inline-block;cursor:pointer;color:#ffffff;font-family:Arial;font-size:16px;font-weight:bold;padding:13px 32px;text-decoration:none;text-shadow:0px 1px 0px #3d768a;" class="myButton"/>
    </form>
    <ul>
<?php
$stmt = $pdo->prepare('SELECT * FROM books WHERE release_date LIKE :year AND title LIKE :title');
$stmt->execute(['year' => '%' . $year . '%', 'title' => '%' . $title . '%']);
echo '<ul>';
while ($row = $stmt->fetch()){
    echo '<li> <a href="./book.php?id=' . $row['id'] . '">'. $row['title'] . '</a></li>';
}
echo '</ul>';

?>
    </ul>

</body>
</html>