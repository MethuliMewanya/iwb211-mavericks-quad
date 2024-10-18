import ballerina/http;

service / on new http:Listener(8080) {

    // Resource to handle form submissions
    resource function post selections(http:Caller caller, http:Request req) returns error? {
        // Retrieve form data from POST request
        map<string|string[]> formData = check req.getFormParams();

        // Initialize response string
        string htmlResponse = "<html><body>";

        // Handle Flavours
        htmlResponse += "<h2>Flavours</h2>";

        if formData.hasKey("flavour[]") {
            var flavourData = formData.get("flavour[]");
            if (flavourData is string) {
                htmlResponse += "<p>" + flavourData + "</p>";
            } else if (flavourData is string[]) {
                string[] flavours = <string[]>flavourData;
                if (flavours.length() > 0) {
                    foreach string flavour in flavours {
                        htmlResponse += "<p>" + flavour + "</p>";
                    }
                } else {
                    htmlResponse += "<p>No flavours selected.</p>";
                }
            }
        } else {
            htmlResponse += "<p>Flavour data not received.</p>";
        }

        // Handle Toppings
        htmlResponse += "<h2>Toppings</h2>";

        if formData.hasKey("topping[]") {
            var toppingData = formData.get("topping[]");
            if (toppingData is string) {
                htmlResponse += "<p>" + toppingData + "</p>";
            } else if (toppingData is string[]) {
                string[] toppings = <string[]>toppingData;
                if (toppings.length() > 0) {
                    foreach string topping in toppings {
                        htmlResponse += "<p>" + topping + "</p>";
                    }
                } else {
                    htmlResponse += "<p>No toppings selected.</p>";
                }
            }
        } else {
            htmlResponse += "<p>Toppings data not received.</p>";
        }

        htmlResponse += "</body></html>";

        // Create the response object
        http:Response res = new;
        res.setPayload(htmlResponse);
        res.setHeader("Content-Type", "text/html");

        // Send the response back to the client
        check caller->respond(res);
    }

    // Resource to handle requests for /favicon.ico to prevent errors
    resource function get favicon(http:Caller caller, http:Request req) returns error? {
        // Create a 204 No Content response for favicon requests
        http:Response res = new;
        res.statusCode = 204; // 204 No Content, as we are not returning a favicon
        check caller->respond(res);
    }
}
