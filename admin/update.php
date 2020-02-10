<?php
    require 'database.php';
//je donne l'id dans l'url, mais je n'ai pas encore rempli le form
    if(!empty($_GET['id'])){
            $id =checkInput($_GET['id']);
    }

// je met au départ toutes mes variables en string vide, pour par la suite mieux les remplir.
    $nameError = $descriptionError = $priceError =$categoryError =$imageError =$name =$description = $price = $category = $image = "";
//validation du formulaire
//ma méthode post est vide car j'ai initié en get
    if(!empty($_POST)){
        $name = checkInput($_POST['name']);
        $description = checkInput($_POST['description']);
        $price = checkInput($_POST['price']);
        $category = checkInput($_POST['category']);
        $image = checkInput($_FILES['image']['name']);
        $imagePath = "../images/" . basename($image); //le chemin de l'image
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);// me donne l'extension de l'image
        $isSuccess = true;
        $isUploadSuccess = false;

        if(empty($name)){
            $nameError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }

        if(empty($description)){
            $descriptionError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($price)){
            $priceError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($category)){
            $categoryError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($image)){
            $isImageUpdated = false;
        }
        else{
            $isImageUpdated = true;
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension !="jpeg" && $imageExtension !="png" && $imageExtension !="gif"){
                $imageError = " Les fichiers autorisés sont: .jpg, jpeg, png, gif.";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)){
                $imageError = "Ce fichier existe déjà!";
                $isUploadSuccess = false;
            }
            if($_FILES['image']['size']>500000){
                $imageError = "Ce fichier ne doit pas dépasser 500KB.";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess){
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)){
                    $imageError = "Il y a eu une erreur lors de l'upload.";
                    $isUploadSuccess = false;
                }
            }

        }
        if(($isSuccess && $isImageUpdated && $isUploadSuccess)|| ($isSuccess && !$isImageUpdated)){
            //(tous mes paramètres de mon form ok && ok image MàJ && ok upload de l'image) OU (tous mes param form ok && est ce que l'img n'a pas été MàJ)
            $db = db::connect();
            if($isImageUpdated){
                //on update avec les data que l'user nous a transmise par le form
                $statement =$db->prepare("UPDATE items set name = ?, description = ?, price = ?, category= ?, image = ? 
                                          WHERE id = ?");
                $statement->execute(array($name,$description,$price,$category,$image,$id));
            }
            else{
                //l'image n'a pas été MàJ
                $statement =$db->prepare("UPDATE items set name = ?, description = ?, price= ?, category=? WHERE id = ?");
                $statement->execute(array($name,$description,$price,$category,$id));
            }
            db::disconnect();
            header('Location: index.php');
        }
        //si l'upload de l'img n'a pas fonctionné
        //je ne veux pas que le nom de l'image soit modifié 
        //et je veux la remettre à sa valeur initiale
        else if($isImageUpdated && !$isUploadSuccess){
            $db = db::connect();
            $statement = $db->prepare("SELECT image FROM items WHERE id =?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image = $item['image'];
            db::disconnect();




        }

    }
    else{
        //je veux récupérer toutes les informations de mon item 
        //dont j'ai attrapé l'id avec le get en ligne 4
        $db = db::connect();
        $statement =$db->prepare("SELECT * FROM items WHERE id = ?");
        $statement->execute(array($id));
        //on va remplir les champs avec les data de la bd avant l'update
        //$item on récupère une ligne qui est un array
        $item           = $statement->fetch();
        $name           =$item['name']; // se mettra dans le champ'nom' du formulaire grace à echo $name
        $description    =$item['description'];
        $price          =$item['price'];
        $category       =$item['category'];
        $image          =$item['image'];

        db::disconnect();

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
        <div class="row">
        <div class="col-sm-6">
            <h1><strong>Modifier un produit</strong></h1>
            <br>
            <!-- action permettra de retourner vers la mm page update -->
            <!-- on va insérer une image donc on met enctype="multipart/form-data  -->
            <form class='form' action='<?php echo "update.php?id=" .$id ?>' method="post" role="form" enctype="multipart/form-data"> 
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
                                if($row['id'] == $category)
                                    echo  '<option selected = "selected" value=" ' .$row['id'] .' ">' . $row['name']. '</option>';
                                else
                                    echo '<option value=" ' .$row['id'] .' ">' . $row['name']. '</option>';

                            } 
                            db::disconnect();
                        ?>
                    </select>
                    <span class="category-inline"><?php echo $descriptionError; ?></span>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <p> <?php echo $image; ?></p>
                    <label for="image">Sélectionner une image:</label>
                    <input type="file" id="image" name="image" >
                    <span class="help-inline"><?php echo $imageError; ?></span>
                </div>
                
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"> <i class="fas fa-pencil-alt"></i> Modifier</button>
                <a class="btn btn-primary" href="index.php"><i class="fas fa-arrow-left"></i> Retour</a>
            </div>
            </form>
        </div>


        <div class="col-sm-6 site">
                <div class="card">
                    <img class="card-img-top" src="<?php echo '../images/' . $image ; ?>" alt="...">
                    <div class="price"><?php echo number_format((float) $price,2,'.','').' €'; ?> </div>
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $name; ?> </h5>
                            <p class="card-text"> <?php echo $description; ?> </p>
                            <a href="#" class="btn btn-order" role="button"> 
                                <i class="fas fa-cart-arrow-down"></i> 
                                Commander
                            </a>
                        </div>
                </div>

        </div>
    </div>
</div>



</body>
</html>
