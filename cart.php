<html>
<body>

<?php
    echo "<h2>Flavours</h2>";
    
    // Access the 'flavour' array from $_POST
    if (isset($_POST['flavour'])) {
        $flavours = $_POST['flavour'];
        
        // Check if the array is not empty
        if (!empty($flavours)) {
            foreach ($flavours as $flavour) {
                echo $flavour . "<br>";
            }
        } else {
            echo "No flavours selected.";
        }
    } else {
        echo "Flavour data not received.";
    }

    echo "<h2>Toppings</h2>";
    
    // Access the 'flavour' array from $_POST
    if (isset($_POST['topping'])) {
        $toppings = $_POST['topping'];
        
        // Check if the array is not empty
        if (!empty($toppings)) {
            foreach ($toppings as $topping) {
                echo $topping . "<br>";
            }
        } else {
            echo "No topping selected.";
        }
    } else {
        echo "Toppings data not received.";
    }
?>

</body>
</html>
