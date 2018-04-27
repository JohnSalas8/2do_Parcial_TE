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

    <div class="container">
        <?php

            $name_f = $_POST["namef"];
            $ap_pat = $_POST["ap_pat"];
            $ap_mat = $_POST["ap_mat"];
            $sexo = $_POST["sexo"];
            $f_naci = $_POST["fecha_nac"];
            $ent_fed = $_POST["ent_fed"];
            $email = $_POST["email"];

            //echo "$name_f<br>$ap_mat<br>$ap_pat<br>$sexo<br>$f_naci<br>$ent_fed<br>$email<br>";

            include("check_email.php");

            if (exist_email($email)) {
                echo "<br><br><h2>El correo electrónico ya existe.</h2><br>De click en el botón de abajo para consultar su CURP.<br><br>";
        ?>
                <form action="show_curp.php" method="post">
                    <table>
                        <tr colspan="2">
                            <div id="titulo-tabla">
                                Consulta CURP
                            </div>
                        </tr>
                        <tr>
                            <td>
                                Correo:
                            </td>
                            <td>
                                <input type="email" name="email" id="" placeholder="Escriba su correo eletrónico">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="checkbox" name="toEmail"> Envíar también a mi correo
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" onsubmit="return cancel_show_curp();">
                                    Mostrar CURP
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
        <?php
            } else {
                //include("connection.php");

                $connection = connect_to_mysql();

                $query = "INSERT INTO users (firstname, lastnamem, lastnamep, gender, email, birthdate, ent_fed) VALUES ('$name_f', '$ap_mat', '$ap_pat', $sexo, '$email', '$f_naci', '$ent_fed');";

                $query = utf8_decode($query);

                $result = exe_query($connection, $query);

                $CURP = print_curp($connection, $email);

                close_connection($connection);

                // ENVIANDO CORREO

                echo "<br>Su CURP también fue enviada a su correo: $email<br>";

                $contenido = "CURP: \n" . $CURP;
                $was_send = mail($email, "Tu CURP", $contenido);

                if ($was_send) {
                    echo "<br>El correo fue enviado con éxito.";
                } else {
                    echo "<br>Hubo un problema al enviar el correo, intentelo mas tarde.";
                }

            }

        ?>
    </div>
</body>
</html>