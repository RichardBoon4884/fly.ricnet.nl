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

$userUrl = filter_input(INPUT_GET, 'userReg', $filter = FILTER_SANITIZE_STRING);

if (isset($_POST['usernameSearch']) and $_POST['usernameSearch'] != '' or isset($userUrl) and $userUrl != "") {
    if (isset($_POST['usernameSearch']) and $_POST['usernameSearch'] != '') {
        $searchUsername = $_POST['usernameSearch'];
    } elseif (isset($userUrl) and $userUrl != "") {
        $searchUsername = $userUrl;
    } else {
        echo "Error: Username error";
        exit();
    }
    
    $sql = "SELECT id, username, email, type, firstname, lastname, active_user, active_pilot, active_dispatcher FROM users WHERE username = '".$searchUsername."'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["username"] == $searchUsername) {
                $formId = $row["id"];
                $formUsername = $row["username"];
                $formEmail = $row["email"];
                $formRole = $row["type"];
                $formFirstname = $row["firstname"];
                $formLastname = $row["lastname"];
                $activeUser = $row["active_user"];
                $activePilot = $row["active_pilot"];
                $activeDispatcher = $row["active_dispatcher"];
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
    if (isset($_POST["activeUser"]) and $_POST["activeUser"] == "activeUser") {
        $inputActiveUser = 1;
    } else {
        $inputActiveUser = 0;
    }
    if (isset($_POST["activePilot"]) and $_POST["activePilot"] == "activePilot") {
        $inputActivePilot = 1;
    } else {
        $inputActivePilot = 0;
    }
    if (isset($_POST["activeDispatcher"]) and $_POST["activeDispatcher"] == "activeDispatcher") {
        $inputActiveDispatcher = 1;
    } else {
        $inputActiveDispatcher = 0;
    }

    if (empty($error_msg)) { // Update user in the database
        
        $sql = "UPDATE users SET email = '".$inputEmail."', type = '".$inputRole."', firstname = '".$inputFirstname."', lastname = '".$inputLastname."', active_user = '".$inputActiveUser."', active_pilot = '".$inputActivePilot."', active_dispatcher = '".$inputActiveDispatcher."' WHERE id = '".$inputId."'";

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