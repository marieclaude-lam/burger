<?php
//je vais me connecter à ma base de donnée burger_code
// pour la POO on crée une classe
class db{

// Ici on va créer des variables afin de changer plus facilement les configurations 
//je vais créer des paramètres en static, car je ne veux pas créer une instance pour me connecter à ma db
//je vais utiliser les membre de connexion de ma classe et non une instance de ma classe

    private static $dbHost = "localhost";
    private static $dbName = "burger_code";
    private static $dbUser = "root";
    private static $dbUserPassword = "root";
// sachant que je retourne ma connexion dans ma fonction connect(), 
//je n'ai donc pas besoin de mettre ma cnx en public, il n'y a que la classe db qui peut y accéder
    private static $cnx = null;
//Je test la conexion à la base de donnée, 
        public static function connect(){
                try{
                    //quand je suis dans une class et que je veux accéder à une propriété qui est en static je dois utiliser self::
                    self::$cnx = new PDO("mysql:host=" . self::$dbHost . ";dbname=". self::$dbName, self::$dbUser, self::$dbUserPassword);
                }

                catch(PDOException $e){
                    die('ERROR:'.$e->getMessage());
                }
                return self::$cnx;
        }

//elle annule la connection
        public static function disconnect(){
            self::$cnx = null;
        }

}
//la fonction connect est public je peux donc l'utiliser en dehors de la class
//db::connect();



?>