<?php
session_start(); // Start the session to access the cart data

// If the order is placed
if (isset($_GET['place_order']) && $_GET['place_order'] == 'true' && isset($_SESSION["cart_item"])) {
    // Generate a unique order number
    $order_number = strtoupper(uniqid("ORD-"));

    // Order details
    $total_quantity = 0;
    $total_price = 0;
    foreach ($_SESSION["cart_item"] as $item) {
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"] * $item["quantity"]);
    }

    // Save the order details in session for reference (optional)
    $_SESSION['order_details'] = [
        'order_number' => $order_number,
        'total_quantity' => $total_quantity,
        'total_price' => $total_price
    ];
    
    // Optionally, you can clear the cart after placing the order
    unset($_SESSION['cart_item']);
} else {
    // Redirect if no order is placed or cart is empty
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="order-summary-container">
        <div class="order-summary-card">
            <div class="order-summary-header">
                <h2>Order Summary</h2>
            </div>

            <div class="order-details">
                <div class="order-detail">
                    <span class="detail-label">Order Number:</span>
                    <span class="detail-value"><?php echo $_SESSION['order_details']['order_number']; ?></span>
                </div>
                <div class="order-detail">
                    <span class="detail-label">Total Items:</span>
                    <span class="detail-value"><?php echo $_SESSION['order_details']['total_quantity']; ?></span>
                </div>
                <div class="order-detail">
                    <span class="detail-label">Total Price:</span>
                    <span class="detail-value">Rs. <?php echo number_format($_SESSION['order_details']['total_price'], 2); ?></span>
                </div>
            </div>

            <div class="thank-you-message">
                <h3>Thank you for your order!</h3>
                <p>Your order has been placed successfully. Your order number is <strong><?php echo $_SESSION['order_details']['order_number']; ?></strong>.</p>
                <p>We will send you a confirmation email shortly.</p>
            </div>

            <div class="action-buttons">
                <a href="index.php" class="btn-continue">Continue Shopping</a>
                <!-- Add Proceed to Payment button -->
                <a href="payment.php" class="btn-payment">Proceed to Payment</a>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .order-summary-container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .order-summary-card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            color: #333;
        }

        .order-summary-header {
            margin-bottom: 20px;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 10px;
        }

        .order-summary-header h2 {
            font-size: 24px;
            color: #4CAF50;
            margin: 0;
        }

        .order-details {
            margin: 20px 0;
        }

        .order-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: bold;
        }

        .detail-value {
            color: #555;
        }

        .thank-you-message h3 {
            font-size: 22px;
            margin-top: 20px;
            color: #4CAF50;
        }

        .thank-you-message p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        .action-buttons {
            margin-top: 30px;
        }

        .btn-continue {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-continue:hover {
            background-color: #45a049;
        }

        /* Style for Proceed to Payment button */
        .btn-payment {
            background-color: #FF5722;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-payment:hover {
            background-color: #E64A19;
        }
    </style>

</body>
</html>

