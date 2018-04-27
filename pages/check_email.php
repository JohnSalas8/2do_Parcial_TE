<?php

    function exist_email($email) {
        include("connection.php");

        $connection = connect_to_mysql();

        $query = "select * from users where users.email='$email'";

        $result = exe_query($connection, $query);

        close_connection($connection);

        if(mysqli_num_rows($result)==0) {
            return false;
        } else {
            return true;
        }
    }

?>