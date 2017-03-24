<form><select class="chosen-select" name="user" id="user">
        <?php foreach ($allUsers as $arrayUser): ?>
            <option value="<?php print $arrayUser["id"]?>"><?php print $arrayUser["firstname"] . " " . $arrayUser["lastname"] . " (" . $arrayUser["username"] . ")"?></option>
        <?php endforeach; ?>
    </select><input type="button" value="Search" onclick="window.location.replace('/admin/edit/' + document.getElementById('user').value)"></form>
<script type="text/javascript">$(".chosen-select").chosen()</script>
