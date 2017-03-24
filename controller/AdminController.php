<?php
require ROOT . 'model/UserModel.php';

class AdminController {
	public function index()
	{
        loginRequired();
        if ($_SESSION["type"] != "administrator") {
            $controller = new ErrorController();
            call_user_func(array($controller, "error404"));
            die();
        }

        renderAdmin();
	}
	public function add()
    {
        loginRequired();
        if ($_SESSION["type"] != "administrator") {
            $controller = new ErrorController();
            call_user_func(array($controller, "error404"));
            die();
        }

        $htmlentities["headAtr"] = "<script type=\"text/JavaScript\" src=\"/js/sha512.js\"></script>\n        <script type=\"text/JavaScript\" src=\"/js/forms.js\"></script>";

        if (isset($_POST['username'], $_POST['email'], $_POST['p'], $_POST['firstname'], $_POST['lastname'], $_POST['role'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Not a valid email

                die();
            }
            $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
            $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

            $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
            if (strlen($password) != 128) {
                // The hashed pwd should be 128 characters long.

                die();
            }
            $userModel = new UserModel();
            $newUserId = $userModel->addUser($username, $email, $password, $role, $firstname, $lastname);

            if (is_numeric($newUserId) and $newUserId != 0) {
                header("Location: /admin/edit/" . $newUserId);
            } else {
                echo "Error: Can't insert to the database.";
            }
        }

        renderAdmin("addUser", array(
        'htmlentities' => $htmlentities));
    }
    public function edit()
    {
        loginRequired();
        if ($_SESSION["type"] != "administrator") {
            $controller = new ErrorController();
            call_user_func(array($controller, "error404"));
            die();
        }

        renderAdmin();
    }
}
