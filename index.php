
<?php 

include 'database.php'; 
$erreurs = "";

//supprimer la todo
if (!empty($_GET['deleteId'])) 
{
    $prepare = $pdo->prepare('
        DELETE FROM
            task
        WHERE
            id = :id
    ');

    $prepare->bindValue('id', $_GET['deleteId']);
    $prepare->execute();
}

// Préparation de la requête


$prepare = $pdo->prepare('
    INSERT INTO 
        task(title, description) 
    VALUES 
        (:title, :description)
');

if (isset($_POST['title']) && isset($_POST['description']))  {  // sert a palier l'erreur du début quand la base de donné est vide
    
    if(empty($_POST['title'])){
        $erreurs = 'Vous devez indiquer un titre au minimum';
    }else{
    $prepare->bindValue('title', $_POST['title']);
    $prepare->bindValue('description', $_POST['description']);
    $prepare->execute();
    }
    
}


//recuperer donnée
$query = $pdo->query("SELECT * FROM task");
$task = $query->fetchAll();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=BenchNine:wght@300&display=swap" rel="stylesheet">
    <title>Todolist</title>
</head>
<body>
<div class="container">
    <div class="rectangle">
        <div class="background">
            <h1>To do List</h1>
            <form class="content" method="post" action="#" data-netlify="true">
            <?php if (isset($erreurs)) { ?>
                <p><?php echo $erreurs ?></p>
                <?php } ?>
                <label for="title">Title</label><br />
                <input type="text" name='title' id="name" placeholder="Name of the task"/>
                <label for="description">What do you need to do today ?</label><br />
                <textarea type="text" name='description' id="description" placeholder="Description"></textarea>
                <div class="button">
                    <input type="submit" value="Add"/>
                </div>
            </form>
        </div>
    </div>
    <div class="rectangle">
        <div class="background">
        <?php foreach ($task as $_tache): ?>
            <div class="tacheafficher">
                <a class="supp_button" href="?deleteId=<?= $_tache->id ?>">x</a>
                <div class="tache">
                
                    <h2><?= $_tache->title ?></h2>
                    <p><?= $_tache->description ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>