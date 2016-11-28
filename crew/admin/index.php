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
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ricnet Fly - Admin area</title>
		<link rel="stylesheet" href="/crew/styles/main.css" />
	</head>
	<body>
		<?php if (login_check($mysqli) == true and $_SESSION['type'] == "administrator") : ?>
		<?php include '/includes_page/header.php'; ?>
        <?php include '/includes_page/sideMenu.php'; ?>
        <main>
            <p>Welcome <?php echo htmlentities($_SESSION['firstname']); ?>, you're are a <?php echo htmlentities($_SESSION['type']); ?>!</p>
        </main>
		<?php else : ?>
			<p>
				<span class="error">You are not authorized to access this page.</span> Please <a href="/crew">return</a>.
			</p>
		<?php endif; ?>
	</body>
</html>