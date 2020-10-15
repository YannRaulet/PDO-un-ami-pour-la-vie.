<?php

require_once 'connect.php';

$pdo = new \PDO(DSN, USER, PASS);
$statement = $pdo->query("SELECT * FROM friend");
$friends = $statement->fetchAll();

foreach ($friends as $friend)
{
    echo "<ul>".PHP_EOL;
    echo "<li>".$friend['firstname']." ".$friend["lastname"]."</li>".PHP_EOL;
    echo "</ul>".PHP_EOL;
};

if (filter_has_var(INPUT_POST, 'firstname') &&
    filter_has_var(INPUT_POST, 'lastname'))
{
    $statement = $pdo->prepare('INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)');
    $statement->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
    $statement->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
    $statement->execute();
    header('Location: /');
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO, un ami pour la vie</title>
</head>
<body>
    <form action="" method="post">
        <label for="firstname">Enter your Firstname : </label>
            <input name="firstname" id="firstname"></br>
        <label for="lastname">Enter your Lastname : </label>
            <input name="lastname" id="lastname"></br>
        <input type="submit" value="Send">
    </form>
</body>
</html>
<?php



