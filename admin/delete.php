<?php
    
    require 'database.php';
//1er passage: on récupère l'item via l'url méthode get
    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);
    }

//2nd passage: on récupère l'id par la méthode post
//Quand je clique sur oui dans le form pour suppr l'item
    if (!empty($_POST)){
        $id = checkInput($_POST['id']);
        $db =db::connect();
        $statement= $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));
        db::disconnect();
        header("Location:index.php");
    }

    function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>


<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Burger Code</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/6a5f3d051e.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">


</head>

<body>

    <h1 class="text-logo">
        <i class="fas fa-utensils"></i>
        Burger Code
        <i class="fas fa-utensils"></i>           
    </h1>
    <div class="container admin">
        <!-- <div class="row"> -->
            <h1><strong>Supprimer un produit</strong></h1>
            <br>
            <!-- action permettra de retourner vers la mm page delete.php -->
            <form class='form' action='delete.php' method="post" role="form" > 
            <input type="hidden" name=id value= "<?php echo $id; ?>"/>
            <p class="alert alert-warning"> Êtes-vous sûr de vouloir supprimer ce produit?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning"> Oui </button>
                <a class="btn btn-default" href="index.php"> Non </a>
            </div>
            </form>
        </div>


            </div>
        <!-- </div> -->
    </div>



</body>
</html>
