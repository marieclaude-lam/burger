<?php
    //on se connecte à base de donnée
    require "database.php";
    //on récupère l'id de l'item grâce à l'url (get) lorsque l'on sélectionne l'article à voir 
    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);//on on se protège des injections sql ac la checkInput()
    }
    $db = db::connect();
    $statement =$db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                                FROM items LEFT JOIN categories ON items.category =categories.id
                                WHERE items.id=?');
    
    $statement->execute(array($id));
    $item = $statement->fetch();// toutes les données sont stockées dans item
    db::disconnect();

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
        <div class="row">
            <div class="col-sm-6">
                <h1><strong><?php echo $item['name']; ?></strong></h1>
                <br>
                <form>
                    <div class="form-group">
                        <label>Nom:</label> <?php echo '  ' . $item['name']; ?>
                    </div>
                    <div class="form-group">
                        <label>Description:</label> <?php echo '  ' . $item['description']; ?>
                    </div>
                    <div class="form-group">
                        <label>Prix:</label> <?php echo '  ' . number_format((float) $item['price'],2,'.',''); ?>
                    </div>
                    <div class="form-group">
                        <label>Catégorie:</label> <?php echo '  ' . $item['category']; ?>
                    </div>
                    <div class="form-group">
                        <label>Image:</label> <?php echo '  ' . $item['image']; ?>
                    </div>
                   
                </form>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php"><i class="fas fa-arrow-left"></i> Retour</a>

                </div>
            </div>
            <div class="col-sm-6 site">
                <div class="card">
                    <img class="card-img-top" src="<?php echo '../images/' . $item['image']  ; ?>" alt="...">
                    <div class="price"><?php echo number_format((float) $item['price'],2,'.',''); ?> </div>
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $item['name']; ?> </h5>
                            <p class="card-text"> <?php echo $item['description']; ?> </p>
                            <a href="#" class="btn btn-order" role="button"> 
                                <i class="fas fa-cart-arrow-down"></i> 
                                Commander
                            </a>
                        </div>
            </div>
        </div>


            </div>
        </div>
    </div>



</body>
</html>


