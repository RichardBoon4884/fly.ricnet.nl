<?php
/**
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ricnet Fly</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="styles/materialize.css"  media="screen,projection"/>
        <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
        <script type="text/JavaScript" src="js/materialize.js"></script> 
        <style type="text/css">
        body {
            background-image: url("/styles/img/index.png");
            background-repeat: no-repeat;
            background-size: 100%;
            margin: 0;
            font-family: Roboto, Arial;
        }
        main {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            background: #fff;
        }
        .frame {
            position: absolute;
            display: inline-block;
            right: 140px;
            width: 500px;
            margin: 20px;
        }
        h2 {
            font-size: 30px;
            margin: 0 0 10px 6px;
            text-transform: uppercase;
        }
        .error {
            display: inline;
            position: absolute;
            right: 0;
        }
        </style>
    </head>
    <body>
        <main>
            <div class="frame">
                <h2>Crew area login</h2>
                <form action="includes/process_login.php" method="post" name="login_form">
                 <div class="row">			
                        <div class="input-field col s6">
                            <input id="email" type="text" name="email" />
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="password" name="password" id="password"/>
                            <label for="password">Password</label>
                        </div>
                        <input class="waves-effect waves-light btn" type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
                        <?php
                            if (isset($_GET['error'])) {
                            echo '<p class="error">Email or password is wrong.</p>';
                        }
                    ?> 
                    </div>
                </form>
            </div>
            <?php if (login_check($mysqli) == true) { header("Location: ../crew/");} ?>
        </main>
    </body>
</html>
