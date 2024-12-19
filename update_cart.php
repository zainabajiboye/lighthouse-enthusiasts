<?php
session_start();

// Check if the action and id are set in the URL query string
if (isset($_GET['action']) && isset($_GET['id'])) {
    $item_id = $_GET['id'];

    if ($_GET['action'] == 'remove') {
        // Remove item from cart
        if (isset($_SESSION['cart'][$item_id])) {
            unset($_SESSION['cart'][$item_id]);
        }
    }

    if ($_GET['action'] == 'update' && isset($_POST['quantity'])) {
        // Update item quantity
        $new_quantity = $_POST['quantity'];

        // Make sure quantity is valid
        if ($new_quantity > 0) {
            $_SESSION['cart'][$item_id]['quantity'] = $new_quantity;
        } else {
            // If the quantity is less than 1, remove the item
            unset($_SESSION['cart'][$item_id]);
        }
    }
}

// Redirect back to the cart page after updating
header("Location: cart.php");
exit();
?>
