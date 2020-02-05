<?php
    
    $nameError = $descriptionError = $priceError =$categoryError =$imageError =$name =$description = $price = $category = $image = "";
    require 'database.php';


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
            <h1><strong>Ajouter un produit</strong></h1>
            <br>
            <!-- action permettra de retourner vers la mm page insert -->
            <!-- on va insérer une image donc on met enctype="multipart/form-data  -->
            <form class='form' action='insert.php' method="post" role="form" enctype="multipart/form-data"> 
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                    <span class="help-inline"><?php echo $nameError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                    <span class="help-inline"><?php echo $descriptionError; ?></span>
                </div>
                <div class="form-group">
                    <label for="price">Description: (en €)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                    <span class="help-inline"><?php echo $priceError; ?></span>
                </div>
                <div class="form-group">
                    <label for="category">Categorie:</label>
                    <select class="form-control" name="category" id="category">
                        <?php
                            $db = db::connect();
                            //à chaque fois que la requete fera une boucle elle la mettra dans la row
                            foreach($db->query('SELECT * FROM categories') as $row){
                                echo '<option value=" ' .$row['id'] .' ">' . $row['name']. '</option>';

                            } 
                            db::disconnect();
                        ?>
                    </select>
                    <span class="category-inline"><?php echo $descriptionError; ?></span>
                </div>
                <div class="form-group">
                    <label for="image">Sélectionner une image:</label>
                    <input type="file" class="form-control" id="image" name="image" value="<?php echo $description; ?>">
                    <span class="help-inline"><?php echo $imageError; ?></span>
                </div>
                
            </form>
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"> <i class="fas fa-pencil-alt"></i> Ajouter</button>
                <a class="btn btn-primary" href="index.php"><i class="fas fa-arrow-left"></i> Retour</a>

            </div>
            
        </div>


            </div>
        </div>
    </div>



</body>
</html>
