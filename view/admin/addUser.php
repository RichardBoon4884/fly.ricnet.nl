
<h1>Add user</h1>

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
    Role:
    <select name='role' id='role'>
        <option value="demo">Demo</option>
        <option value="user">User</option>
        <option value="administrator">Administrator</option>
    </select><br>
    <input type="button"
           value="Add user"
           onclick="return regformhash(this.form,
                                           this.form.username,
                                           this.form.email,
                                           this.form.password,
                                           this.form.confirmpwd,
                                           this.form.firstname,
                                           this.form.lastname,
                                           this.form.role);" />
</form>