<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font: 14px sans-serif; }
        .wrapper { width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <form method="get" action="">
        <label for="role">Select a Role:</label>
        <select name="role" id="role">
            <option value="consumer">Consumer</option>
            <option value="provider">Provider</option>
        </select>
        <br>

        <div id="subRoleDiv" style="display:none;">
            <label for="subrole">Select a Sub-Role:</label>
            <select name="subrole" id="subrole">
                <option value="none">None</option>
                <option value="hotel">Hotel</option>
                <option value="restaurant">Restaurant</option>
            </select>
        </div>
        <br>

        <input type="submit" value="Submit">
    </form>

    <script>
        // Show/hide the sub-role dropdown based on the selected role.
        document.getElementById("role").addEventListener("change", function () {
            var subRoleDiv = document.getElementById("subRoleDiv");
            if (this.value === "provider") {
                subRoleDiv.style.display = "block";
            } else {
                subRoleDiv.style.display = "none";
            }
        });

        // Handle form submission with JavaScript
        document.querySelector("form").addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent the default form submission

            var role = document.getElementById("role").value;
            var subRole = document.getElementById("subrole").value;

            // Perform redirection based on role and sub-role
            if (role === "consumer") {
                window.location.href = "/signup/consumer";
            } else if (role === "provider" && subRole === "hotel") {
                window.location.href = "/signup/hotelProvider";
            } else if (role === "provider" && subRole === "restaurant") {
                window.location.href = "/signup/restaurantProvider";
            }
        });
    </script>
</body>
</html>
