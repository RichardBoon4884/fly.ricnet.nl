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
include_once '../../includes/updateUser.inc.php';
include_once '../../includes/functions.php';

sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ricnet Fly - Admin area - Edit user</title>
        <script type="text/JavaScript" src="/js/sha512.js"></script> 
        <script type="text/JavaScript" src="/js/forms.js"></script>
        <link rel="stylesheet" href="/crew/styles/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true and $_SESSION['type'] == "administrator") : ?>
            <?php include '/includes_page/header.php'; ?>
            <?php include '/includes_page/sideMenu.php'; ?>
            <main>
                <h1>Edit user</h1>
                <?php
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
                ?>
                <?php
                    $nameUrl = filter_input(INPUT_GET, 'user', $filter = FILTER_SANITIZE_STRING);
                    if ($nameUrl == null):
                ?>
                <script type="text/javascript">
                    function user() {
                        let userNameInput = document.getElementById('username').value;
                        let localUrl = 'http://localhost:8000/crew/admin/editUser.php?user=';
                        window.location = localUrl + userNameInput;
                    }
                </script>
                Username: <input type='text' name='username' id='username'/><button onclick="user()">Go</button><br>
                <?php elseif ($nameUrl != null): ?>
                <ul>
                    <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
                    <li>Emails must have a valid email format</li>
                    <li>Passwords must be at least 6 characters long</li>
                    <li>Passwords must contain
                        <ul>
                            <li>At least one upper case letter (A..Z)</li>
                            <li>At least one lower case letter (a..z)</li>
                            <li>At least one number (0..9)</li>
                        </ul>
                    </li>
                    <li>Your password and confirmation must match exactly</li>
                </ul>
                <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
                    Username: <input type='text' name='username' id='username' /><br>
                    Email: <input type="text" name="email" id="email" /><br>
                    Password: <input type="password"
                                     name="password" 
                                     id="password"/><br>
                    Confirm password: <input type="password" 
                                             name="confirmpwd" 
                                             id="confirmpwd" /><br>
                    First name: <input type='text' name='firstname' id='firstname' /><br>
                    Last name: <input type='text' name='lastname' id='lastname' /><br>
                    Role: <select name='role' id='role'><option value="demo">Demo</option><option value="user">User</option><option value="administrator">Administrator</option></select><br>
                    <input type="button" 
                           value="Register" 
                           onclick="return regformhash(this.form,
                                           this.form.username,
                                           this.form.email,
                                           this.form.password,
                                           this.form.confirmpwd,
                                           this.form.firstname,
                                           this.form.lastname,
                                           this.form.role);" /> 
                </form>
                <?php endif; ?>
            </main>
        <?php elseif ($_SESSION['type'] != "administrator"): ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> You need to be an administrator.
            </p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="/">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>
