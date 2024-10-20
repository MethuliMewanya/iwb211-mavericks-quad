import ballerina/http;

// Declare the shopping cart as a map globally
map<json> shoppingCart = {};

service /shoppingCart on new http:Listener(8080) {

    // Endpoint to add an item to the cart
    resource function post addToCart(http:Caller caller, http:Request req) returns error? {
        // Get JSON payload
        json payload = check req.getJsonPayload();

        // Safely extract and cast each value using `cloneWithType()`
        int itemId = check (check payload.itemId).cloneWithType(int);
        string itemName = check (check payload.itemName).cloneWithType(string);
        float itemPrice = check (check payload.itemPrice).cloneWithType(float);
        int itemQuantity = check (check payload.itemQuantity).cloneWithType(int);

        // Add or update the cart with the item
        json cartItem = {
            "itemId": itemId,
            "itemName": itemName,
            "itemPrice": itemPrice,
            "itemQuantity": itemQuantity
        };

        // Update or add the item to the shopping cart map
        shoppingCart[itemName] = cartItem;

        // Respond with success
        check caller->respond("Item added to cart successfully");

        return ();
    }

    // Endpoint to remove an item from the cart
    resource function post deleteItem(http:Caller caller, http:Request req) returns error? {
        // Get JSON payload
        json payload = check req.getJsonPayload();

        // Safely extract itemName from JSON
        string itemName = check (check payload.itemName).cloneWithType(string);

        if shoppingCart.hasKey(itemName) {
            json _ = shoppingCart.remove(itemName);
            check caller->respond("Item removed from cart successfully");
        } else {
            check caller->respond("Item not found in cart");
        }

        return ();
    }

    // Endpoint to retrieve cart details
    resource function get cartDetails(http:Caller caller, http:Request req) returns error? {
        json cartItems = shoppingCart.toJson();
        check caller->respond(cartItems);

        return ();
    }
}

// import ballerina/http;

// Declare the shopping cart as a map globally
// map<json> shoppingCart = {};

service /shoppingCart on new http:Listener(8080) {

    // Endpoint to add an item to the cart
    resource function post addToCart(http:Caller caller, http:Request req) returns error? {
        // Get JSON payload
        json payload = check req.getJsonPayload();

        // Safely extract and cast each value using `cloneWithType()`
        int itemId = check (check payload.itemId).cloneWithType(int);
        string itemName = check (check payload.itemName).cloneWithType(string);
        float itemPrice = check (check payload.itemPrice).cloneWithType(float);
        int itemQuantity = check (check payload.itemQuantity).cloneWithType(int);

        // Add or update the cart with the item
        json cartItem = {
            "itemId": itemId,
            "itemName": itemName,
            "itemPrice": itemPrice,
            "itemQuantity": itemQuantity
        };

        // Update or add the item to the shopping cart map
        shoppingCart[itemName] = cartItem;

        // Respond with success
        check caller->respond("Item added to cart successfully");

        return ();
    }

    // Endpoint to remove an item from the cart
    resource function post deleteItem(http:Caller caller, http:Request req) returns error? {
        // Get JSON payload
        json payload = check req.getJsonPayload();

        // Safely extract itemName from JSON
        string itemName = check (check payload.itemName).cloneWithType(string);

        if shoppingCart.hasKey(itemName) {
            json _ = shoppingCart.remove(itemName);
            check caller->respond("Item removed from cart successfully");
        } else {
            check caller->respond("Item not found in cart");
        }

        return ();
    }

    // Endpoint to retrieve cart details
    resource function get cartDetails(http:Caller caller, http:Request req) returns error? {
        json cartItems = shoppingCart.toJson();
        check caller->respond(cartItems);

        return ();
    }
}

