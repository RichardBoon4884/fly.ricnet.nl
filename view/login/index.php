<?php $backgrounds = array("/styles/img/index.png", "/styles/img/index1.png", "/styles/img/index2.png", "/styles/img/index3.png", "/styles/img/index4.png"); ?>
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
            background-image: url("<?php echo $backgrounds[rand(0, sizeof($backgrounds)-1)];?>");
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
        h1 {
            position: absolute;
            margin: 0;
            left: 180px;
            top: 50%;
            transform: translateY(-50%);
        }
        </style>
    </head>
    <body>
        <main>
            <h1><img src="/img/logo_ricnetfly.png" alt="ricnet air"></h1>
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
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>
