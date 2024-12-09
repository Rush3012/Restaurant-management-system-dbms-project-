<?php
include("auth.php");
require("dbcontroller.php");
require_once("db.php");

$email = $_SESSION['email'];  // Get the logged-in user's email

$db_handle = new DBController();

if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        // Add item to cart
        case "add":
            if (!empty($_POST["quantity"]) && is_numeric($_POST["quantity"])) {
                $quantity = (int)$_POST["quantity"];
            } else {
                $quantity = 1; // Default to 1 if quantity is not set or invalid
            }

            // Get product details from the menu
            $productByCode = $db_handle->runQuery("SELECT * FROM menu WHERE code='" . $_GET["code"] . "'");
            $itemArray = array(
                $productByCode[0]["code"] => array(
                    'name' => $productByCode[0]["name"],
                    'code' => $productByCode[0]["code"],
                    'quantity' => $quantity,
                    'price' => $productByCode[0]["price"],
                    'image' => $productByCode[0]["image"]
                )
            );

            // If cart is not empty, check if the item is already in the cart
            if (!empty($_SESSION["cart_item"])) {
                if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        if ($productByCode[0]["code"] == $k) {
                            if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"]; // Increment quantity
                        }
                        
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray); // Add new item to cart
                }
            } else {
                $_SESSION["cart_item"] = $itemArray; // If cart is empty, set the new item
            }
            break;

        // Insert items from the cart into the orders table
        case "insert":
    if (!empty($_SESSION["cart_item"])) {
        foreach ($_SESSION["cart_item"] as $k => $v) {
            // Get item details from the session
            $quantity1 = $_SESSION["cart_item"][$k]["quantity"];
            
            // Validate quantity (fallback to 1 if invalid)
            if (empty($quantity1) || !is_numeric($quantity1)) {
                $quantity1 = 1; // Default value for quantity
            }
            
            $code1 = $_SESSION["cart_item"][$k]["code"];
            $email1 = $_SESSION["email"];
            $total=($_SESSION["cart_item"][$k]["price"])*($_SESSION["cart_item"][$k]["quantity"]);
            $price = $_SESSION["cart_item"][$k]["price"];
            $total_price = $price * $quantity1; // Total price for this item
            $ord_date1 = date("Y-m-d");
            $ord_time1 = date('H:i');

            // Query to fetch customer ID from the customer table using the email
            $customerQuery = "SELECT customer_id FROM customer WHERE email='$email1'";
            $customerResult = $db_handle->runQuery($customerQuery);

            if (!empty($customerResult)) {
                $customer_id = $customerResult[0]['customer_id'];

                // Insert the order into the 'orders' table
                $done1 = $db_handle->insq("
                    INSERT INTO orders (`customer_id`, `total`,`email`, `ord_date`, `code`, `quantity`, `ord_time`, `total_payment`) 
                    VALUES ('$customer_id', '$total','$email1', '$ord_date1', '$code1', '$quantity1', '$ord_time1', '$total_price')
                ");
            }
        }

        // Clear the cart after all orders have been inserted
        unset($_SESSION["cart_item"]);
    }
    break;

        // Remove item from the cart
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["code"] == $k) {
                        unset($_SESSION["cart_item"][$k]); // Remove item from the cart
                    }
                    // If cart is empty, unset the session variable
                    if (empty($_SESSION["cart_item"])) {
                        unset($_SESSION["cart_item"]);
                    }
                }
            }
            break;

        // Empty the cart
        case "empty":
            unset($_SESSION["cart_item"]);
            break; 
    }
}
?>

<html lang="en">


<head>
    <TITLE>Menu</TITLE>
    <link rel="stylesheet" href="css/shop.css" type="text/css" />
    <link href="//db.onlinewebfonts.com/c/465b1cbe35b5ca0de556720c955abece?family=AbolitionW00-Regular" rel="stylesheet"
        type="text/css" />
    <meta charset="utf-8">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,700i&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body data-aos-easing="ease-out-back" data-aos-duration="1500" data-aos-delay="0">
    <nav class="navbar navbar-expand-md navbar-dark position-sticky-top fixed-top">
        <div class="canvas-area">
            <div class="head1">
                <a class="navbar-logo" href="#"><img src="img/logo.png"
                        style="height:35px; width: 214px;padding-top:1px"> </a></div>
            <div class="flot">
                <button class="navbar-toggler" type="button " style="float: right" data-toggle="collapse"
                    data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon "></span>
                </button>
            </div>

            <div class="collapse navbar-collapse text-right" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">about</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservation.php">reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">
                            <p><?php
            $query1="select name from customer where email='$email'";
            $nameg = mysqli_query($con,$query1);
            while ($row = mysqli_fetch_assoc($nameg)) {
                echo $row['name']."<br>";
            }?></p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <div class="col-md-7" id="product-grid">
        <?php
	$product_array = $db_handle->runQuery("SELECT * FROM menu ORDER BY id asc");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
    ?>
        <div class="container-fluid" id="prohov">
            <div class="product-item foo-2">
                <form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                    <div class="product-image"><img
                            style="height:130px;margin-left:10px;margin-top:15px;border-radius:50px;display:flex;width:170px;background-size:cover;background-position:center center;position:relative;background-repeat:no-repeat;"
                            src="dishes/<?php echo $product_array[$key]["image"]; ?>">
                    </div>

                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                        <div class="product-description"><?php echo $product_array[$key]["descrip"]; ?></div>

                    </div>

                    <div class="lower">
                        <div class="cart-action"><input type="text" class="product-quantity fix2" name="quantity"
                                value="1" size="2" /><input type="submit" value="Add to Cart"
                                class="btnAddAction fix1" /></div>
                    </div>
                    <div class="product-price"><?php echo "Rs.".$product_array[$key]["price"]; ?></div>
                </form>
            </div>
        </div>
        <?php
		}
	}
	?>
    </div>
    <div class="right">
    <div id="shopping-cart">
        <div class="txt-heading">Shopping Cart</div>

        <?php
        if (isset($_SESSION["cart_item"])) {
            $total_quantity = 0;
            $total_price = 0;
        ?>
            <table class="tbl-cart" cellpadding="10" cellspacing="2" style="padding-top:10px;">
                <tbody>
                    <tr>
                        <th style="text-align:left;" width="30%">Name</th>
                        <th style="text-align:right;" width="5%">Quantity</th>
                        <th style="text-align:right;" width="20%">Unit Price</th>
                        <th style="text-align:right;" width="10%">Price</th>
                        <th style="text-align:center;" width="5%">Remove</th>
                    </tr>
                    <?php
                    foreach ($_SESSION["cart_item"] as $item) {
                        $item_price = $item["quantity"] * $item["price"];
                    ?>
                        <tr>
                            <td>
                                <img src="dishes/<?php echo $item["image"]; ?>" class="cart-item-image" style="height:50px;width:50px;" />
                                <?php echo $item["name"]; ?>
                            </td>
                            <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                            <td style="text-align:right;"><?php echo "Rs." . $item["price"]; ?></td>
                            <td style="text-align:right;"><?php echo "Rs." . number_format($item_price, 2); ?></td>
                            <td style="text-align:center;">
                                <a href="menu.php?action=remove&code=<?php echo $item["code"]; ?>">
                                    <img src="icon-delete.png" alt="Remove Item" />
                                </a>
                            </td>
                        </tr>
                    <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["price"] * $item["quantity"]);
                    }
                    ?>

                    <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td align="right"><?php echo $total_quantity; ?></td>
                        <td align="right" colspan="2">
                            <strong><?php echo "Rs. " . number_format($total_price, 2); ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
	
        <?php
        } else {
        ?>
            <div class="no-records">Your Cart is Empty</div>
        <?php
        }
        ?>

            <?php if (isset($item)) { ?>
    		<a type="button" onclick="myFunction()" id="btnorder"
        	    href="order-summary.php?place_order=true">Place order</a>
<?php } ?>

                <a id="btnEmpty" href="menu.php?action=empty">Empty Cart</a>
                <p id="myP" style="visibility: hidden;font-family:'Montserrat';color: #d00000;float:left; text-decoration: none;
    margin-left: 20px !important;
    margin: 10px 0px;">Your orders have been placed</p>

        </div>

    </div>

</BODY>
<script>
    // GENERAL SETTING
    window.sr = ScrollReveal({
        reset: true
    });

    // Custom Settings
    sr.reveal('.foo-1', {
        duration: 200
    });

    sr.reveal('.foo-2', {
        origin: 'right',
        duration: 200
    });

    sr.reveal('.foo-3', {
        rotate: {
            x: 100,
            y: 100,
            z: 0
        },
        duration: 1000
    });

    sr.reveal('.foo-4', {
        viewFactor: 0.3
    });

    sr.reveal('.foo-5', {
        duration: 200
    });
</script>
<script>
    function myFunction() {
        document.getElementById("myP").style.visibility = "visible";
    }
</script>

</HTML>
