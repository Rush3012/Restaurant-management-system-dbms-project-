<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/

require('../db.php');
//include("adminauth.php");

// Count total number of customers
$customer_count_query = "SELECT COUNT(*) AS total_customers FROM customer";
$customer_count_result = mysqli_query($con, $customer_count_query);
$customer_count_row = mysqli_fetch_assoc($customer_count_result);
$total_customers = $customer_count_row['total_customers'];

// Query to count orders for each menu item
$order_count_query = "
    SELECT m.name, COUNT(o.code) AS order_count, SUM(o.quantity) AS total_quantity
    FROM menu m
    LEFT JOIN orders o ON m.code = o.code
    GROUP BY m.code";
$order_count_result = mysqli_query($con, $order_count_query);

// Query for top 5 ordered items
$top_items_query = "
    SELECT m.name, SUM(o.quantity) AS total_quantity
    FROM menu m
    LEFT JOIN orders o ON m.id = o.code
    GROUP BY m.code
    ORDER BY total_quantity DESC
    LIMIT 5";
$top_items_result = mysqli_query($con, $top_items_query);

// Query for top 5 customers
$top_customers_query = "
    SELECT c.name, COUNT(o.id) AS total_orders
    FROM customer c
    JOIN orders o ON c.customer_id = o.customer_id
    GROUP BY c.customer_id
    ORDER BY total_orders DESC
    LIMIT 5";
$top_customers_result = mysqli_query($con, $top_customers_query);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>View Records</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="form">
        <p><a href="../control.php">Home</a> | <a href="adinsert.php">Insert New Record</a> | <a href="../logout.php">Logout</a></p>
        <h2>View Records</h2>

        <p>Total Customers: <?php echo $total_customers; ?></p>

        <h3>Orders Summary:</h3>
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><strong>Item Name</strong></th>
                    <th><strong>Total Orders</strong></th>
                    <th><strong>Total Quantity Ordered</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($order_count_result)) { ?>
                    <tr>
                        <td align="center"><?php echo $row["name"]; ?></td>
                        <td align="center"><?php echo $row["order_count"]; ?></td>
                        <td align="center"><?php echo $row["total_quantity"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Top 5 Ordered Items:</h3>
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><strong>Item Name</strong></th>
                    <th><strong>Total Quantity Ordered</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($top_items_result)) { ?>
                    <tr>
                        <td align="center"><?php echo $row["name"]; ?></td>
                        <td align="center"><?php echo $row["total_quantity"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Top 5 Customers:</h3>
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><strong>Customer Name</strong></th>
                    <th><strong>Total Orders</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($top_customers_result)) { ?>
                    <tr>
                        <td align="center"><?php echo $row["name"]; ?></td>
                        <td align="center"><?php echo $row["total_orders"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3>Customer Records:</h3>
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th><strong>S.No</strong></th>
                    <th><strong>Name</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Address</strong></th>
                    <th><strong>Phone</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                $sel_query = "SELECT * FROM customer ORDER BY cust_id ASC";
                $result = mysqli_query($con, $sel_query);
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td align="center"><?php echo $count; ?></td>
                        <td align="center"><?php echo $row["name"]; ?></td>
                        <td align="center"><?php echo $row["email"]; ?></td>
                        <td align="center"><?php echo $row["address"]; ?></td>
                        <td align="center"><?php echo $row["phone"]; ?></td>
                        <td align="center"><a href="adedit.php?id=<?php echo $row["cust_id"]; ?>">Edit</a></td>
                        <td align="center"><a href="addelete.php?id=<?php echo $row["cust_id"]; ?>">Delete</a></td>
                    </tr>
                <?php $count++;
                } ?>
            </tbody>
        </table>

        <br /><br /><br /><br />
    </div>
</body>

</html>

