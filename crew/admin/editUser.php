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
                    if (isset($formUsername) == false):
                ?>
                <form method="post">
                    Username: <input type="username" name="usernameSearch">
                    <input type="submit" name="send" value="Go">
                </form>
                <?php
                    elseif (isset($_POST['usernameSearch']) and $_POST['usernameSearch'] != '' and $_POST['usernameSearch'] == $formUsername or isset($userUrl) and $userUrl != "" and $userUrl == $formUsername):
                ?>           
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
                <form method="post" name="registration_form" action="">
                    Username: <input type='text' name='username' id='username' value="<?php echo $formUsername; ?>" />
                    <input type='number' name='userId' id='userId' value="<?php echo $formId; ?>"  style="display: none;"/><br>
                    Email: <input type="text" name="email" id="email" value="<?php echo $formEmail; ?>"/><br>
                    First name: <input type='text' name='firstname' id='firstname' value="<?php echo $formFirstname; ?>"/><br>
                    Last name: <input type='text' name='lastname' id='lastname' value="<?php echo $formLastname; ?>"/><br>
                    Role:
                    <select name='role' id='role'>
                        <option value="demo" <?php if ($formRole == 'demo') {echo 'selected="selected"';} ?>>Demo</option>
                        <option value="user" <?php if ($formRole == 'user') {echo 'selected="selected"';} ?>>User</option>
                        <option value="administrator" <?php if ($formRole == 'administrator') {echo 'selected="selected"';} ?>>Administrator</option></select><br>
                    <input type="checkbox" name="activeUser" value="activeUser" <?php if ($activeUser == 1) {echo "checked";} ?>> Active user<br>
                    <input type="checkbox" name="activePilot" value="activePilot" <?php if ($activePilot == 1) {echo "checked";} ?>> Active pilot<br>
                    <input type="checkbox" name="activeDispatcher" value="activeDispatcher" <?php if ($activeDispatcher == 1) {echo "checked";} ?>> Active dispatcher<br>
                    <input type="button" 
                           value="Update" 
                           onclick="return updateUserFormCheck(this.form,
                                           this.form.username,
                                           this.form.email,
                                           this.form.firstname,
                                           this.form.lastname,
                                           this.form.role,
                                           this.form.userId);" />
                </form>
                <form method="post">
                    Password: <input type="password"
                                     name="password" 
                                     id="password"/><br>
                    Confirm password: <input type="password" 
                                             name="confirmpwd" 
                                             id="confirmpwd" /><br>
                    <input type='number' name='userId' id='userId' value="<?php echo $formId; ?>"  style="display: none;"/>
                    <input type="button" 
                           value="Update" 
                           onclick="return updateUserFormPasswd(this.form,
                                           this.form.password,
                                           this.form.confirmpwd);" />
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
