<?php
namespace view;
include_once ('model/Model.php');
include_once('model/Patient.php');

class View
{

    private $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function showPatienten($result = null){
        if($result == 1){
            echo "<h4>Actie geslaagd</h4>";
        }
        $patienten = $this->model->getPatienten();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht medicijnen | HealthOne</title>
                    <link rel=\"icon\" href=\"img/HealthOneProject.png\">
                    <style>
                    body {font-family: Arial, Helvetica, sans-serif; background-color: #f2f2f2;}
                        #patienten{
                            display:grid;
                            grid-template-columns:repeat(4,1fr);                
                            grid-column-gap:10px;
                            grid-row-gap:10px;
                            justify-content: center;
                        }
                        .patient{
                            width:80%;
                            background-color:#b6e1fc;
                            color:darkslategray;
                            font-size:24px;
                            padding:10px;
                            border-radius:10px;
                        }
                    </style>
                </head>
                <body>";

        echo " 
        <head>
            <style>
                input.logout{
                    float: right;
                }
            </style>
        </head>
        <body>
            <form action='index.php' method='post'>
                <input type='hidden' name='logout' value='0'>
                <input type='submit' value='Uitloggen'/>
            </form>
        </body>
        ";

        echo "
        <head>
        <style>
        body {font-family: Arial, Helvetica, sans-serif; background-color: #f2f2f2;}
        h1{
            text-align: center;
            font-size: 35px;
            background-color: lightskyblue;
            color: white;
            border-radius: 20px;
            margin: 20px 10px 20px 10px;
            padding: 2px 0px;
        }
        </style>
        </head>
        <body>
        <h1>Medicijnen overzicht</h1>
        <form action='index.php' method='post'>
            <input type='hidden' name='showForm' value='0'>
            <input type='submit' value='toevoegen'/>
        </form>
        </div>
        </body>
        </html>";
        if($patienten !== null) { echo "
                        <div id=\"patienten\">";
            foreach ($patienten as $patient) {
                echo "<div class=\"patient\">
                                       
                                      $patient->naam<br />
                                      $patient->werking<br />
                                      $patient->bijwerking<br />
                                      $patient->verzekerd<br />
                                      <form action='index.php' method='post'>
                                       <input type='hidden' name='showForm' value='$patient->id'><input type='submit' value='wijzigen'/></form>
                                        <form action='index.php' method='post'>
                                       <input type='hidden' name='delete' value='$patient->id'><input type='submit' value='verwijderen'/></form>
                                    </div>";
            }
        }
        else{
            echo "Geen medicijnen gevonden";
        }

    }
    public function showFormPatienten($id=null){
        if($id !=null && $id !=0){
            $patient = $this->model->selectPatient($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer medicijngegevens | HealthOne</title>
            <link rel=\"icon\" href=\"img/HealthOneProject.png\">
            <style>
            body {font-family: Arial, Helvetica, sans-serif; background-color: #f2f2f2;}
            </style>
            <script>
            function goBack() {
            window.history.back();
            }
            </script>
        </head>
        <body>
        <h2>Formulier medicijngegevens</h2>";
        if(isset($patient)){
            echo "<form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"naam\">Medicijn naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= '".$patient->naam."'/></td></tr>
            <tr><td>
                <label for=\"werking\">werking</label></td><td>
                <input type=\"text\" name=\"werking\" value = '".$patient->werking."'/></td></tr>
            <tr><td>
                <label for=\"bijwerking\">bijwerking</label></td><td>
                <input type=\"text\" name=\"bijwerking\" value= '".$patient->bijwerking."'/></td></tr>
            <tr><td>
                <label for=\"verzekerd\">verzekerd</label></td><td>
                <input type=\"text\" name=\"verzekerd\" value= '".$patient->verzekerd."'/></td></tr>
            <tr><td>
                <button onclick='goBack()'>Terug</button></td><td>
                <input type='submit' name='update' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
        else{
            /*de html template */
            echo "<form method='post' action='index.php'>
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value=''/></td></tr>
             <tr><td>   <label for=\"naam\">Medicijn naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= ''/></td></tr>
            <tr><td>
                <label for=\"werking\">werking</label></td><td>
                <input type=\"text\" name=\"werking\" value = ''/></td></tr>
            <tr><td>
                <label for=\"bijwerking\">bijwerking</label></td><td>
                <input type=\"text\" name=\"bijwerking\" value= ''/></td></tr>
            <tr><td>
                <label for=\"verzekerd\">verzekerd</label></td><td>
                <input type=\"text\" name=\"verzekerd\" value= ''/></td></tr>
            <tr><td>
                <button onclick='goBack()'>Terug</button>
                <input type='submit' name='create' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
    }

    // public function showLogin()
    // {
    //     echo "
    //     <!DOCTYPE html>
    //     <html lang=\"en\">
    //     <head>
    //         <meta charset=\"UTF-8\">
    //         <title>login</title>
    //     </head>
    //     <body>
    //     <form method=\"post\" action=\"index.php\">
    //     <tabel>

    //     <tr><td>    <label for=\"username\">username</label></td></tr>
    //             <input type=\"text\" name=\"username\" value=''/></td></tr>

    //     <tr><td>
    //             <label for=\"password\">password</label></td></tr>
    //             <input type=\"password\" name=\"password\" /></td></tr>

    //     <tr><td>
    //             <input type='submit' name='login' value='Inloggen'></td></tr>
    //         </td></tr></tabel>
    //     </form>

    //     </body>
    //     </html>
    //     ";
    // }

    public function showLogin()
    {
        echo "
        <html>
        <head>
        <title>Login | HealthOne</title>
        <link rel=\"stylesheet\" href=\"./css/login.css\">
        <link rel=\"icon\" href=\"img/HealthOneProject.png\">
        <style>
        body {font-family: Arial, Helvetica, sans-serif; background-color: #f2f2f2;}
        </style>
        </head>
        <body>
            <form class=\"modal-content animate\" action=\"./index.php\" method=\"post\">
                <div class=\"imgcontainer\">
                    <img src=\"./img/HealthOneProject.png\" alt=\"Avatar\" class=\"avatar\">
                </div>
            
                <div class=\"container\">
                    <label for=\"username\"><b>Gebruikersnaam:</b></label>
                    <input placeholder=\"Voer uw gebruikersnaam in...\" type=\"text\" name=\"username\" required>
            
                    <label for=\"password\"><b>Wachtwoord:</b></label>
                    <input placeholder=\"Voer uw wachtwoord in...\" type=\"password\" name=\"password\" required>
                    
                    <button type=\"submit\" name=\"login\">Inloggen</button>
                    <label>
                        <input type=\"checkbox\" checked=\"checked\" name=\"remember\"> Remember me
                    </label>
                </div>
            
                <div class=\"container\" style=\"background-color:#f1f1f1\">
                <span class=\"psw\"><a href=\"#\"> Forgot password?</a></span>
                </div>
            </form>
        </body>
        </html>
        ";
    }
}