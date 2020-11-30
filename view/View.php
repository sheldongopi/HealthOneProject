<?php
namespace view;

class View
{
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