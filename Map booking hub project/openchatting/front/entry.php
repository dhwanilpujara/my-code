<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/../private/config.php";


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div id="chat">
        <?php
        $query = "SELECT * FROM chat_messages";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<strong>" . $row['username'] . ":</strong> " . $row['message'] . "<br>";
        }
        ?>
    </div>

    <form id="chatForm">
        <input type="text" id="message" placeholder="Type your message">
        <input type="hidden" id="username" value="<?php echo $_SESSION['username']; ?>">
        <button type="submit">Send</button>
    </form>

    <script>
        $(document).ready(function () {
            // AJAX to update chat messages without refreshing the page
            function updateChat() {
                $.ajax({
                    url: "get_messages.php", // PHP script to retrieve messages
                    type: "GET",
                    success: function (data) {
                        $("#chat").html(data);
                    }
                });
            }

            // Submit new messages via AJAX
            $("#chatForm").submit(function (e) {
                e.preventDefault();
                var message = $("#message").val();
                $.ajax({
                    url: "send_message.php", // PHP script to send messages
                    type: "POST",
                    data: { message: message },
                    success: function () {
                        updateChat();
                        $("#message").val("");
                    }
                });
            });

            // Update chat every 2 seconds (adjust as needed)
            setInterval(updateChat, 2000);
        });
    </script>
</body>
</html>
