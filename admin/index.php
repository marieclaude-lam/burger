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
            <h1><strong>Liste des Items    </strong>
            <a href="insert.php" class="btn btn-success btn-lg"> <i class="fas fa-plus"></i>      Ajouter </a>
            </h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width=336px>
                            <a class="btn btn-secondary" href="view.php"><i class="fas fa-eye"></i> Voir</a>
                            <a class="btn btn-primary" href="update.php"><i class="fas fa-pencil-alt"></i> Modifier</a>
                            <a class="btn btn-danger" href="delete.php"><i class="far fa-trash-alt"></i> Supprimer</a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>




</body>
</html>