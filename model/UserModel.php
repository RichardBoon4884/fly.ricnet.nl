<?php

class UserModel {
	public function getAllUsers($par1 = null)
	{
		$db = openDb();

		if ($par1 == "activePilots") {
			$sth = $db->prepare("SELECT id, firstname, lastname FROM users WHERE `active_pilot` = 1");
		} elseif ($par1 == "activeDispatchers") {
			$sth = $db->prepare("SELECT id, firstname, lastname FROM users WHERE `active_dispatcher` = 1");
		} else {
			$sth = $db->prepare("SELECT id, firstname, lastname FROM users");
		}

		$sth->execute();

		$result = $sth->fetchAll();
		$db = closeDb();
		return $result;
	}
}