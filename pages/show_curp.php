<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CURP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">Get My CURP</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../index.php">Inicio</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="consult_curp.php"><span class="glyphicon glyphicon-user"></span> CURP</a></li>
                    <li><a href="sign_in.php"><span class="glyphicon glyphicon-log-in"></span> Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <?php

            include("check_email.php");

            $email = $_POST['email'];
            $toEmail = $_POST['toEmail'];

            if (exist_email($email)) {
                $connection = connect_to_mysql();

                $CURP = print_curp($connection, $email);

                close_connection($connection);

                if ($toEmail=='on') {
                    echo "<br>Su CURP también fue enviada a su correo: $email<br>";

                    $contenido = "CURP: \n" . $CURP;
                    $was_send = mail($email, "Tu CURP", $contenido);

                    if ($was_send) {
                        echo "<br>El correo fue enviado con éxito.";
                    } else {
                        echo "<br>Hubo un problema al enviar el correo, intentelo mas tarde.";
                    }
                }

            } else {
                echo "<br>Correo inexistente.<br>";
            }

        ?>
    </div>
</body>
</html>