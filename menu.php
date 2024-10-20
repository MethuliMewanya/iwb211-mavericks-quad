<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "maverick");

if (isset($_POST["add_to_cart"])) {
        if (isset($_SESSION["shopping_cart"])) {
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                if (!in_array($_GET["id"], $item_array_id)) {
                        $count = count($_SESSION["shopping_cart"]);
                        $item_array = array(
                                'item_id' => $_GET["id"],
                                'item_name' => $_POST["hidden_name"],
                                'item_price' => floatval($_POST["hidden_price"]), 
                                'item_quantity' => intval($_POST["quantity"]) 
                        );
                        $_SESSION["shopping_cart"][$count] = $item_array;
                } else {
                        echo '<script>alert("Item Already Added")</script>';
                }
        } else {
                $item_array = array(
                        'item_id' => $_GET["id"],
                        'item_name' => $_POST["hidden_name"],
                        'item_price' => floatval($_POST["hidden_price"]), 
                        'item_quantity' => intval($_POST["quantity"])
                );
                $_SESSION["shopping_cart"][0] = $item_array;
        }
}

if(isset($_POST["abort"])){
        session_destroy();
        echo '<script>window.location="index.php"</script>';
}

if (isset($_GET["action"])) {
        if ($_GET["action"] == "delete") {
                foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                        if ($values["item_id"] == $_GET["id"]) {
                                unset($_SESSION["shopping_cart"][$keys]);
                                echo '<script>window.location="menu.php"</script>';
                        }
                }
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ice Cream Toppings</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="menu.css">
        <style>
                .sticky {
                        position: fixed;
                        top: 0;
                        width: 100%;
                }
        </style>
</head>

<body>
        <div class="header" id="myHeader">
                <div class="d-flex justify-content-between mt-4" id="button-group">
                        <a href="index.php"><button class="btn btn-danger m-2">← Home</button></a>
                        <a href="#cart"><button class="btn btn-danger m-2">Cart</button></a>
                        <!-- <a href="#cart"><button class="btn btn-danger m-2">Confirm</button></a> -->
                </div>
                <div class="d-flex justify-content-between mt-4" id="button-group">
                        <!-- <a href="home.html"><button class="btn btn-danger m-2">← Home</button></a> -->
                        <a href="#"></a><!-- <a href="home.html"><button class="btn btn-danger m-2" onclick="confirm()">Confirm</button></a> -->
                        <form method="post" action="menu.php">
                        <input type="submit" name="abort" style="margin-top:5px;" class="btn btn-success" value="Confirm" onclick="confirm()"/>
                        </form>
                </div>
        </div>
        <script>
                function confirm(){
                        alert("Thank you and come again!!!");
                        
                }
                window.onscroll = function () { myFunction() };

                var header = document.getElementById("myHeader");
                var sticky = header.offsetTop;

                function myFunction() {
                        if (window.pageYOffset > sticky) {
                                header.classList.add("sticky");
                        } else {
                                header.classList.remove("sticky");
                        }
                }
        </script>
        <div class="container text-center mt-5">
                <h1 class="flavour-title" id="flav">Flavours</h1>
                <div class="row mt-4">
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=1">
                                        <img src="./images/flavours/c.jpg" alt="Chocolate" class="circle-img">
                                        <p class="p-p">Chocolate</p>
                                        <p class="p-p">Rs 200/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="1" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="1" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-1"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Chocolate" />
                                        <input type="hidden" name="hidden_price" value="200.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=2">
                                        <img src="./images/flavours/v.jpeg" alt="Vanila" class="circle-img">
                                        <p class="p-p">Vanila</p>
                                        <p class="p-p">Rs 200/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="2" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="2" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-2"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Vanila" />
                                        <input type="hidden" name="hidden_price" value="200.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=3">
                                        <img src="./images/flavours/s.jpeg" alt="Strawberry" class="circle-img">
                                        <p class="p-p">Strawberry</p>
                                        <p class="p-p">Rs 250/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="3" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="3" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-3"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Strawberry" />
                                        <input type="hidden" name="hidden_price" value="250.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=4">
                                        <img src="./images/flavours/mc.jpg" alt="Mint Chocolate Chip"
                                                class="circle-img">
                                        <p class="p-p">Mint Chocolate Chip</p>
                                        <p class="p-p">Rs 250/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="4" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="4" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-4"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Mint Chocolate Chip" />
                                        <input type="hidden" name="hidden_price" value="250.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=5">
                                        <img src="./images/flavours/cc.jpg" alt="Cookies n' Cream" class="circle-img">
                                        <p class="p-p">Cookies n' Cream</p>
                                        <p class="p-p">Rs 250/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="5" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="5" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-5"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Cookies n Cream" />
                                        <input type="hidden" name="hidden_price" value="250.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=6">
                                        <img src="./images/flavours/bs.jpg" alt="Butterscotch" class="circle-img">
                                        <p class="p-p">Butterscotch</p>
                                        <p class="p-p">Rs 250/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="6" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="6" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-6"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Butterscotch" />
                                        <input type="hidden" name="hidden_price" value="250.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=7">
                                        <img src="./images/flavours/sc.jpeg" alt="Strawberry Cheesecake"
                                                class="circle-img">
                                        <p class="p-p">Strawberry Cheesecake</p>
                                        <p class="p-p">Rs 250/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="7" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="7" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-7"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Strawberry Cheesecake" />
                                        <input type="hidden" name="hidden_price" value="250.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4" id="flavour-container">
                                <form method="post" action="menu.php?action=add&id=8">
                                        <img src="./images/flavours/rr.jpg" alt="Rum Raisin" class="circle-img">
                                        <p class="p-p">Rum Raisin</p>
                                        <p class="p-p">Rs 250/scoop</p>
                                        <div class="custom-button">
                                                <svg onclick="decreaseValue(this)" data-id="8" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 13H5v-2h14v2z"></path>
                                                </svg>
                                                <span class="counter">0</span>
                                                <svg onclick="increaseValue(this)" data-id="8" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"></path>
                                                </svg>
                                        </div>
                                        <input type="hidden" name="quantity" value="1" id="quantity-8"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Rum Raisin" />
                                        <input type="hidden" name="hidden_price" value="250.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                </div>
                <br><br><br>
                <h1 class="flavour-title" id="topp">Toppings</h1>
                <div class="row mt-4">
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=9">
                                        <img src="./images/toppings/sp.jpeg" alt="Sprinkles" class="circle-img">
                                        <p class="p-p">Sprinkles</p>
                                        <p class="p-p">Rs 50</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Sprinkles" />
                                        <input type="hidden" name="hidden_price" value="50.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=10">
                                        <img src="./images/toppings/hot.jpg" alt="Hot Fudge" class="circle-img">
                                        <p class="p-p">Hot Fudge</p>
                                        <p class="p-p">Rs 50</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Hot Fudge" />
                                        <input type="hidden" name="hidden_price" value="50.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=11">
                                        <img src="./images/toppings/ch.jpeg" alt="Maraschino Cherries"
                                                class="circle-img">
                                        <p class="p-p">Maraschino Cherries</p>
                                        <p class="p-p">Rs 50</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Maraschino Cherries" />
                                        <input type="hidden" name="hidden_price" value="50.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=12">
                                        <img src="./images/toppings/wh.jpeg" alt="Whipped Cream" class="circle-img">
                                        <p class="p-p">Whipped Cream</p>
                                        <p class="p-p">Rs 50</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Whipped Cream" />
                                        <input type="hidden" name="hidden_price" value="50.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=13">
                                        <img src="./images/toppings/nuts.jpg" alt="Crushed Nuts" class="circle-img">
                                        <p class="p-p">Crushed Nuts</p>
                                        <p class="p-p">Rs 50</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Crushed Nuts" />
                                        <input type="hidden" name="hidden_price" value="50.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=14">
                                        <img src="./images/toppings/oreo.jpg" alt="Crushed Oreo" class="circle-img">
                                        <p class="p-p">Crushed Oreo</p>
                                        <p class="p-p">Rs 70</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Crushed Oreo" />
                                        <input type="hidden" name="hidden_price" value="70.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=15">
                                        <img src="./images/toppings/brownie.jpg" alt="Brownie Bites" class="circle-img">
                                        <p class="p-p">Brownie Bites</p>
                                        <p class="p-p">Rs 100</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Brownie Bites" />
                                        <input type="hidden" name="hidden_price" value="100.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                        <div class="col-4 col-md-3 mb-4">
                                <form method="post" action="menu.php?action=add&id=16">
                                        <img src="./images/toppings/gummy.jpg" alt="Gummy Bears" class="circle-img">
                                        <p class="p-p">Gummy Bears</p>
                                        <p class="p-p">Rs 50</p>
                                        <input type="hidden" name="quantity" value="1" id="quantity"
                                                class="form-control" />
                                        <input type="hidden" name="hidden_name" value="Gummy Bears" />
                                        <input type="hidden" name="hidden_price" value="50.00" />
                                        <input type="submit" name="add_to_cart" style="margin-top:5px;"
                                                class="btn btn-success" value="Add" />
                                </form>
                        </div>
                </div>
        </div>

        <script>
                function increaseValue(element) {
                        const counterElement = element.parentElement.querySelector('.counter');
                        let currentValue = parseInt(counterElement.textContent);
                        currentValue += 1;
                        counterElement.textContent = currentValue;
                        const itemId = element.getAttribute('data-id');
                        document.getElementById('quantity-' + itemId).value = currentValue;
                }

                function decreaseValue(element) {
                        const counterElement = element.parentElement.querySelector('.counter');
                        let currentValue = parseInt(counterElement.textContent);
                        if (currentValue > 1) {
                                currentValue -= 1;
                        }
                        counterElement.textContent = currentValue;
                        const itemId = element.getAttribute('data-id');
                        document.getElementById('quantity-' + itemId).value = currentValue;
                }
        </script>
        <div style="clear:both; padding: bottom 200px;"></div>
        <br />
        <h3 id="cart" class="flavour-title">Order Details</h3>
        <div class="table-responsive">
                <table class="table table-bordered">
                        <tr>
                                <th width="40%" class="p-p">Item Name</th>
                                <th width="10%" class="p-p">Quantity</th>
                                <th width="20%"class="p-p">Price</th>
                                <th width="15%"class="p-p">Total</th>
                                <th width="5%"class="p-p"> </th>
                        </tr>
                        <?php
                        if (!empty($_SESSION["shopping_cart"])) {
                                $total = 0;
                                foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                                        ?>
                                        <tr>
                                                <td class="p-p"><?php echo $values["item_name"]; ?></td>
                                                <td class="p-p"><?php echo $values["item_quantity"]; ?></td>
                                                <td class="p-p">Rs <?php echo number_format(floatval($values["item_price"]), 2); ?></td>
                                                <td class="p-p">Rs <?php echo number_format(intval($values["item_quantity"]) * floatval($values["item_price"]), 2); ?>
                                                </td>
                                                <td class="p-p"><a href="menu.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span
                                                                        class="text-danger">Remove</span></a></td>
                                        </tr>
                                        <?php
                                        $total += intval($values["item_quantity"]) * floatval($values["item_price"]);
                                }
                                ?>
                                <tr>
                                        <td colspan="3" align="right" class="p-p">Total</td>
                                        <td align="right" class="p-p">Rs <?php echo number_format($total, 2); ?></td>
                                        <td></td>
                                </tr>
                                <?php
                        }
                        ?>
                </table>
        </div>

</body>

</html>