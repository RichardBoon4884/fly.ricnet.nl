<?php

class UserModel {
	public function getAllUsers($par1 = null)
	{
		$db = openDb();

		if ($par1 == "activePilots") {
			$sth = $db->prepare("SELECT id, username, firstname, lastname FROM users WHERE `active_pilot` = 1");
		} elseif ($par1 == "activeDispatchers") {
			$sth = $db->prepare("SELECT id, username, firstname, lastname FROM users WHERE `active_dispatcher` = 1");
		} else {
			$sth = $db->prepare("SELECT id, username, firstname, lastname FROM users");
		}

		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();
		return $result;
	}
    public function getUser($par1)
    {
        $db = openDb();

        if (is_numeric($par1)) {
            $sth = $db->prepare("SELECT `id`, `username`, `email`, `type`, `firstname`, `lastname`, `active_user`, `active_pilot`, `active_dispatcher` FROM users WHERE id = :userId LIMIT 1");
            $sth->bindParam(':userId', $par1);
        } elseif (filter_var($par1, FILTER_VALIDATE_EMAIL)) {
            $sth = $db->prepare("SELECT `id`, `username`, `email`, `type`, `firstname`, `lastname`, `active_user`, `active_pilot`, `active_dispatcher` FROM users WHERE email = :email LIMIT 1");
            $sth->bindParam(':email', $par1);
        } else {
            $sth = $db->prepare("SELECT `id`, `username`, `email`, `type`, `firstname`, `lastname`, `active_user`, `active_pilot`, `active_dispatcher` FROM users WHERE username = :username LIMIT 1");
            $sth->bindParam(':username', $par1);
        }

        $sth->execute();

        $result = $sth->fetchAll();
        $db = closeDb();
        return $result;
    }
    public function addUser($username, $email, $password, $role, $firstname, $lastname)
    {
        $db = openDb();

        $result = $this->getUser($username);
        if (count($result) == 1) {
            // Username already exist.
            echo "Username already exist. ";
            return false;
            // TODO: Improve error messages.
        }
        $result = $this->getUser($email);
        if (count($result) == 1) {
            // Email already exist.
            echo "Email already exist. ";
            return false;
            // TODO: Improve error messages.
        }

        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
        $password = hash('sha512', $password . $random_salt);

        $sth = $db->prepare("INSERT INTO users (`username`,
                `email`,
                `password`,
                `salt`,
                `type`,
                `firstname`,
                `lastname`)
				VALUES (
				:username,
				:email,
				:password,
				:salt,
				:type,
				:firstname,
				:lastname)");
        $sth->bindParam(':username', $username);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $password);
        $sth->bindParam(':salt', $random_salt);
        $sth->bindParam(':type', $role);
        $sth->bindParam(':firstname', $firstname);
        $sth->bindParam(':lastname', $lastname);

        $succes = $sth->execute();

        $lastId = $db->lastInsertId();

        $result = $sth->fetchAll();
        $db = closeDb();

        if ($succes == true) {
            return $lastId;
        } else {
            return false;
        }
    }
}