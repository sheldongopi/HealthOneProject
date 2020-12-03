<?php


namespace model;
include_once ('model/Patient.php');
include_once ('User.php');
class Model
{
    private $database;

    private function makeConnection(){
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
    }

    public function login($username, $password){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `users`
            WHERE `users`.`username` =:username');
        $selection->bindParam(":username",$username);
        $result = $selection->execute();
        if($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\User::class);
            $user = $selection->fetch();
            if ($user) {
                $gethashtpassword = strtoupper(hash("sha256",$password));
                //var_dump($gethashtpassword);
                if ($user->getPassword() == $gethashtpassword) {
                    $_SESSION['user'] = $user->getUsername();
                    $_SESSION['role'] = $user->getRole();
                }
            }
        }
    }
    public function logout(){
        session_unset();
        session_destroy();
    }

    public function insertPatient($naam,$werking,$bijwerking,$verzekerd){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `medicijnen` (`id`, `naam`, `werking`, `bijwerking`, `verzekerd`) 
                VALUES (NULL, :naam, :werking, :bijwerking, :verzekerd)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":werking", $werking);
            $query->bindParam(":bijwerking",$bijwerking);
            $query->bindParam(":verzekerd", $verzekerd);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.


    }
    public function updatePatient($id,$naam,$werking,$bijwerking,$verzekerd){
        $this->makeConnection();

        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare (
            "UPDATE `medicijnen` SET `naam` = :naam, `werking`=:werking, `bijwerking` = :bijwerking,
            `verzekerd`=:verzekerd WHERE `medicijnen`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":naam", $naam);
        $query->bindParam(":werking", $werking);
        $query->bindParam(":bijwerking",$bijwerking);
        $query->bindParam(":verzekerd", $verzekerd);
        $result = $query->execute();
        return $result;
    }

    public function getPatienten(){

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `medicijnen`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS,\model\Patient::class);
            return $result;
        }
        return null;
    }
    public function selectPatient($id){

        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `medicijnen` 
            WHERE `medicijnen`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        if($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\Patient::class);
            $patient = $selection->fetch();
            return $patient;
        }
        return null;
    }
    public function deletePatient($id){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `medicijnen` 
            WHERE `medicijnen`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        return $result;
    }

}