<?php
session_start();

// Check if order details exist in the session
if (!isset($_SESSION['order_details'])) {
    header('Location: order_summary.php'); // Redirect to order summary if no order details
    exit();
}

$order_details = $_SESSION['order_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="payment-container">
        <div class="payment-card">
            <h2 class="payment-header">Payment Details</h2>

            <div class="payment-summary">
                <p><strong>Order Number:</strong> <?php echo $order_details['order_number']; ?></p>
                <p><strong>Total Items:</strong> <?php echo $order_details['total_quantity']; ?></p>
                <p><strong>Total Price:</strong> Rs. <?php echo number_format($order_details['total_price'], 2); ?></p>
            </div>

            <div class="payment-options">
                <h3>Select Payment Method</h3>
                <form action="process_payment.php" method="post">
                    <div class="payment-method">
                        <label>
                            <input type="radio" name="payment_method" value="credit_card" required>
                            <span class="method-label">Credit Card</span>
                        </label>
                    </div>
                    <div class="payment-method">
                        <label>
                            <input type="radio" name="payment_method" value="paypal" required>
                            <span class="method-label">PayPal</span>
                        </label>
                    </div>
                    <div class="payment-method">
                        <label>
                            <input type="radio" name="payment_method" value="cash" required>
                            <span class="method-label">Cash on Delivery</span>
                        </label>
                    </div>
                    <button type="submit" class="btn-submit">Proceed with Payment</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .payment-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            color: #333;
        }

        .payment-header {
            text-align: center;
            color: #4CAF50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .payment-summary {
            margin: 20px 0;
            font-size: 18px;
            color: #555;
        }

        .payment-summary p {
            margin: 10px 0;
        }

        .payment-options h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        .payment-method {
            display: flex;
            align-items: center;
            margin: 15px 0;
            font-size: 18px;
        }

        .payment-method input[type="radio"] {
            margin-right: 10px;
            accent-color: #4CAF50;
        }

        .method-label {
            color: #333;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .payment-container {
                width: 100%;
                padding: 15px;
            }

            .payment-header {
                font-size: 24px;
            }

            .payment-summary {
                font-size: 16px;
            }

            .payment-method {
                font-size: 16px;
            }

            .btn-submit {
                font-size: 16px;
                padding: 12px 16px;
            }
        }
    </style>

</body>
</html>

