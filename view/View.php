<?php
namespace view;

class View
{
    public function showPatienten($result = null){
        if($result == 1){
            echo "<h4>Actie geslaagd</h4>";
        }
        $patienten = $this->model->getPatienten();

        // var_dump($patienten);die();
        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <style>
                        #patienten{
                            display:grid;
                            grid-template-columns:repeat(4,1fr);                
                            grid-column-gap:10px;
                            grid-row-gap:10px;
                            justify-content: center;
                        }
                        .patient{
                            width:80%;
                            background-color:#ccccff;
                            color:darkslategray;
                            font-size:24px;
                            padding:10px;
                            border-radius:10px;
                        }
                    </style>
                </head>
                <body>";
        echo "  <form action='index.php' method='post'>
                       <input type='hidden' name='logout' value='0'>
                       <input type='submit' value='Uitloggen'/>
                       </form>";
}

    public function showLogin()
    {
        echo "
            <!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <title>login</title>
            </head>
            <body>
            <form method=\"post\" method=\"index.php\">
                <table>
                
                    <tr><td>    <label for='username''>username</label></tb><tb> 
                            <input type=\"text\" name=\"username\" /></tb><tr>
                    <tr><td>
                        <label for=\"password\">password</label></tb><tb> 
                        <input type=\"password\" name=\"password\" /></tb><tr>
                    <tr><td>
                            <input type='submit' name='login' value='Inloggen'></td><td>
                        </td></tr></table>
        </form>
        
        </body>
        </html>
    ";
    }
}