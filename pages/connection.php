<?php

    function connect_to_mysql() {
        $server = "localhost";
        $user = "root";
        $pswd = "*********";
        $bdd = "*****";

        // ESTE TIPO DE CONEXION ES SIN USAR PHPMYADMIN
        $connection = mysqli_connect($server, $user, $pswd) or die ("No se ha podido conectar con MySQL.");
        mysqli_set_charset("UTF8", $connection);
        mysqli_select_db($connection, $bdd) or die ("No existe la basde de datos con el nombre: $bdd");

        return $connection;
    }

    function close_connection($connection) {
        mysqli_close($connection);
    }

    function exe_query($connection, $query) {
        return mysqli_query($connection, $query);
    }

    function isVocal($ch) {
        return ($ch=='A' || $ch=='E' || $ch=='I' 
        || $ch=='O' || $ch=='U');
    }

    function searchNotVocal($index, $string) {
        for ($i=$index; $i < strlen($string); $i++) {
            if (!isVocal($string[$i])) {
                return $string[$i];
            }
        }
    }

    function searchVocal($index, $string) {
        for ($i=$index; $i < strlen($string); $i++) {
            if (isVocal($string[$i])) {
                return $string[$i];
            }
        }
    }

    function print_curp($connection, $email) {
        $query = "call getCURP('$email');";

        // echo "<br>" . $query . "<br>";

        $result = exe_query($connection, $query);

        // echo "<br>" . mysqli_num_rows($result) . "<br>";

        $line = mysqli_fetch_array($result);

        $CURP = '';

        $firstname = str_replace(" ", "", $line['firstname']);
        $lastnamem = str_replace(" ", "", $line['lastnamem']);
        $lastnamep = str_replace(" ", "", $line['lastnamep']);
        $part_curp = $line['part_curp'];
        $not_copy = $line['not_copy'];
        $digit_compr = $line['digit_compr'];

        // Inicial y primera vocal interna del primer apellido;
        $CURP .= $lastnamep[0];
        $CURP .= searchVocal(1, $lastnamep);
        // inicial del segundo apellido e, inicial del nombre de pila
        $CURP .= $lastnamem[0];
        $CURP .= $firstname[0];

        // Fecha de nacimiento año, mes y dia en dos digitios cada uno; esto ya lo hago en MySQL
        // Sexo: (H) = 1; (M) = 0
        // Entidad federativa de nacimiento; esto ya lo hago en MySQL
        $CURP .= $part_curp;

        // Primeras consonantes internas del primer apellido, del segudno apellido y del nombre de pila
        $CURP .= searchNotVocal(1, $lastnamep);
        $CURP .= searchNotVocal(1, $lastnamem);
        $CURP .= searchNotVocal(1, $firstname);

        $CURP .= $not_copy . $digit_compr;

        $CURP = utf8_encode($CURP);

        echo "<br>CURP:<br><h1>$CURP</h1>";

        return $CURP;
    }
        
?>