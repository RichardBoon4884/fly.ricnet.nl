<?php

/* 
 * Copyright (C) 2013 peter
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

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['usernameSearch']) and $_POST['usernameSearch'] != '') {
    $sql = "SELECT id, username, email, type, firstname, lastname FROM users WHERE username = '".$_POST['usernameSearch']."'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["username"] == $_POST['usernameSearch']) {
                $formId = $row["id"];
                $formUsername = $row["username"];
                $formEmail = $row["email"];
                $formRole = $row["type"];
                $formFirstname = $row["firstname"];
                $formLastname = $row["lastname"];
            }
        }
    }
}


if (isset($_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['role'], $_POST['userId'])) {
    $inputUsername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $inputEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $inputEmail = filter_var($inputEmail, FILTER_VALIDATE_EMAIL);
    if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
    $inputFirstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $inputLastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $inputRole = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $inputId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);

    if (empty($error_msg)) { // Update user in the database
        echo $inputLastname.'<br>'.$inputId.'<br>';
        
        $sql = "UPDATE users SET email = '".$inputEmail."', type = '".$inputRole."', firstname = '".$inputFirstname."', lastname = '".$inputLastname."' WHERE id = '".$inputId."'";

        if ($mysqli->query($sql) === TRUE) {
            echo "User updated";
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
    }
}

if (isset($_POST['p'])) {
    $inputId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);

    $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

    // Create salted password 
    $password = hash('sha512', $password . $random_salt);

    if (empty($error_msg)) { // Update user in the database        
        $sql = "UPDATE users SET password = '".$password."', salt = '".$random_salt."' WHERE id = '".$inputId."'";

        if ($mysqli->query($sql) === TRUE) {
            echo "User updated";
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
    }
}