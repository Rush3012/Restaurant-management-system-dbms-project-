<?php

include("adminauth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/admin.css" />
</head>
<body>
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area.</p>


<p><a href="admin/adinsert.php">Insert New Record</a></p>
<p><a href="admin/adview.php">View Records</a><p>
<p><a href="logout.php">Logout</a></p>



<br /><br /><br /><br />
</div>
</body>
</html>
