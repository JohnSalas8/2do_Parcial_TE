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
        <form id="formulario" action="curp.php" method="post" onsubmit="return cancel_sign_in();">
            <table>
                <tr>
                    <tr colspan="2">
                        <div id="titulo-tabla">
                            Registrarse
                        </div>
                    </tr>
                </tr>
                <tr>
                    <td>
                        Nombre(s):
                    </td>
                    <td>
                        <input type="text" name="namef" id="firstname" placeholder="Escribe tu(s) nombre(s)">
                    </td>
                </tr>
                <tr>
                    <td>
                        Primer Apellido:
                    </td>
                    <td>
                        <input type="text" name="ap_pat" id="lastnamep" placeholder="Escribe tu apellido paterno">
                    </td>
                </tr>
                <tr>
                    <td>
                        Segundo Apellido:
                    </td>
                    <td>
                        <input type="text" name="ap_mat" id="lastnamem" placeholder="Escribe tu apellido materno">
                    </td>
                </tr>
                <tr>
                    <td>
                        Sexo:
                    </td>
                    <td>
                        <input type="radio" name="sexo" value="1" id=""> Hombre
                        <input type="radio" name="sexo" value="0" id=""> Mujer
                    </td>
                </tr>
                <tr>
                    <td>
                        Fecha de Nacimiento:
                    </td>
                    <td>
                        <input type="date" name="fecha_nac" id="birthdate" 
                        max=<?php echo "\"" . date("Y") . "-" . date("m") . "-" . date("d") . "\"" ?>>                        
                    </td>
                </tr>
                <tr>
                    <td>
                        Entidad Federativa:
                    </td>
                    <td>
                        <select name="ent_fed" id="ent_fed">
                            <?php

                                echo "<option value=\"0\">Selecciona Una Entidad</option>";
                                include("connection.php");

                                $connection = connect_to_mysql();
                                
                                $result = exe_query($connection, "select * from entidad_federativa;");
                                
                                while ($line = mysqli_fetch_array($result)) {
                                    echo "<option value=\"" . $line['siglas'] . "\">";
                                    echo $line['name_ent'];
                                    echo "</option>"; 
                                }

                                close_connection($connection);

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Correo:
                    </td>
                    <td>
                        <input type="email" name="email" id="email" placeholder="Escriba su correo electrónico">
                    </td>
                </tr>
                <tr>
                    <td id="mssg" colspan="2">
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" onclick>Generar CURP</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>