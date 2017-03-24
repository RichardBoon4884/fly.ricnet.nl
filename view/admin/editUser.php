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
    Username: <input type='text' name='username' id='username' value="<?php echo $user["username"]; ?>" />
    <input type='number' name='userId' id='userId' value="<?php echo $user["id"]; ?>"  style="display: none;"/><br>
    Email: <input type="text" name="email" id="email" value="<?php echo $user["email"]; ?>"/><br>
    First name: <input type='text' name='firstname' id='firstname' value="<?php echo $user["firstname"]; ?>"/><br>
    Last name: <input type='text' name='lastname' id='lastname' value="<?php echo $user["lastname"]; ?>"/><br>
    Role:
    <select name='role' id='role'>
        <option value="demo" <?php if ($user["type"] == 'demo') {echo 'selected="selected"';} ?>>Demo</option>
        <option value="user" <?php if ($user["type"] == 'user') {echo 'selected="selected"';} ?>>User</option>
        <option value="administrator" <?php if ($user["type"] == 'administrator') {echo 'selected="selected"';} ?>>Administrator</option></select><br>
    <input type="checkbox" name="activeUser" value="activeUser" <?php if ($user["active_user"] == 1) {echo "checked";} ?>> Active user<br>
    <input type="checkbox" name="activePilot" value="activePilot" <?php if ($user["active_pilot"] == 1) {echo "checked";} ?>> Active pilot<br>
    <input type="checkbox" name="activeDispatcher" value="activeDispatcher" <?php if ($user["active_dispatcher"] == 1) {echo "checked";} ?>> Active dispatcher<br>
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
    <input type='number' name='userId' id='userId' value="<?php echo $user["id"]; ?>"  style="display: none;"/>
    <input type="button"
           value="Update"
           onclick="return updateUserFormPasswd(this.form,
                                           this.form.password,
                                           this.form.confirmpwd);" />
</form>