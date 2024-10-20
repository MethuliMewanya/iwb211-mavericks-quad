<?php
// Initialize variables
$totalPrice = 0;
$selectedFlavours = [];
$selectedToppings = [];

// Get selected flavours
if (!empty($_POST['flavours'])) {
    foreach ($_POST['flavours'] as $flavour => $quantity) {
        if ($quantity > 0) {
            $price = ($flavour === "Chocolate" || $flavour === "Vanilla") ? 200 : 250; // Example pricing logic
            $totalPrice += $price * $quantity;
            $selectedFlavours[] = ['name' => $flavour, 'quantity' => $quantity, 'price' => $price];
        }
    }
}

// Get selected toppings
if (!empty($_POST['toppings'])) {
    foreach ($_POST['toppings'] as $topping) {
        list($name, $price) = explode('|', $topping);
        $totalPrice += (int)$price;
        $selectedToppings[] = ['name' => $name, 'price' => (int)$price];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Order Summary</h1>
        <h2>Flavours</h2>
        <?php if (!empty($selectedFlavours)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Flavour</th>
                    <th>Quantity</th>
                    <th>Price (per scoop)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selectedFlavours as $flavour): ?>
                <tr>
                    <td><?= $flavour['name']; ?></td>
                    <td><?= $flavour['quantity']; ?></td>
                    <td>Rs <?= $flavour['price']; ?></td>
                    <td>Rs <?= $flavour['quantity'] * $flavour['price']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No flavours selected.</p>
        <?php endif; ?>

        <h2>Toppings</h2>
        <?php if (!empty($selectedToppings)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Topping</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selectedToppings as $topping): ?>
                <tr>
                    <td><?= $topping['name']; ?></td>
                    <td>Rs <?= $topping['price']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No toppings selected.</p>
        <?php endif; ?>

        <h3>Total Price: Rs <?= $totalPrice; ?></h3>
    </div>
</body>
</html>
