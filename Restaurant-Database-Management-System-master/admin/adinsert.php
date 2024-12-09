<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/
 
require('../db.php');
//include("adminauth.php");

$status = "";
if (isset($_POST['new']) && $_POST['new'] == 1) {
    // Escape and sanitize input
    $name = mysqli_real_escape_string($con, stripslashes($_POST['name']));
    $description = mysqli_real_escape_string($con, stripslashes($_POST['description']));
    $price = mysqli_real_escape_string($con, stripslashes($_POST['price']));
    $available = mysqli_real_escape_string($con, stripslashes($_POST['available']));
    $code = mysqli_real_escape_string($con, stripslashes($_POST['code']));

    // Handle image upload
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $image = "/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Insert query
    $query = "INSERT INTO `menu` (name, description, price, available, code, image) 
              VALUES ('$name', '$description', '$price', '$available', '$code', '$image')";
    if (mysqli_query($con, $query)) {
        echo "New menu item added successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }


mysqli_query($con,$query) or die(mysql_error());
$status = "New Record Inserted Successfully.</br></br><a href='adview.php'>View Inserted Record</a>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Insert New Record</title>
    <link rel="stylesheet" href="css/style1.css" />
</head>

<body>
    <div class="form">
        <p><a href="../control.php">Dashboard</a> | <a href="adview.php">View Records</a> | <a href="../logout.php">Logout</a>
        </p>

        <div>
            <h1>Insert New Record</h1>
            <form name="menu_form" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="new" value="1" />
    
    <!-- Menu Item Name -->
    <label for="name">Menu Item Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter menu item name" maxlength="100" required />
    <br><br>
    
    <!-- Description -->
    <label for="description">Description:</label>
    <textarea id="description" name="description" placeholder="Enter description (optional)" rows="3" cols="30"></textarea>
    <br><br>
    
    <!-- Price -->
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" placeholder="Enter price" required />
    <br><br>
    
    <!-- Available -->
    <label for="available">Available:</label>
    <select id="available" name="available">
        <option value="1" selected>Yes</option>
        <option value="0">No</option>
    </select>
    <br><br>
    
    <!-- Code -->
    <label for="code">Unique Code:</label>
    <input type="text" id="code" name="code" placeholder="Enter unique code" maxlength="50" required />
    <br><br>
    
    <!-- Image -->
    <label for="image">Image:</label>
    <input type="file" id="image" name="image" accept="image/*" />
    <br><br>
    
    <!-- Submit Button -->
    <input type="submit" name="submit" value="Add Menu Item" />
</form>


            <p style="color:#FF0000;"><?php echo $status; ?></p>

            <br /><br /><br /><br />
            
                
        </div>
    </div>
</body>

</html>
