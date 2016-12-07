		<header>
			<h1>Ricnet Fly</h1>
			<nav>
				<ul>
                    <?php if ($_SESSION['type'] == 'administrator') {echo '<li><a id="admin" href="/crew/admin">Admin area</a></li>';} ?>
                    <li><a id="logout" href="/includes/logout.php">log out</a></li>
                    <li><span><?php echo htmlentities($_SESSION['firstname']); ?></span></li>
                </ul>
			</nav>
		</header>