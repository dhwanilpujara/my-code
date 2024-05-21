<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talkies</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #username-container {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #username-input {
            padding: 10px;
            margin-bottom: 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #set-username-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        #set-username-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="username-container">
        <label for="username-input">Enter your name:</label>
        <input type="text" id="username-input" placeholder="Your Name">
        <button onclick="setUsername()" id="set-username-btn">Make this as username</button>
    </div>

    <script>
        function setUsername() {
            const usernameInput = document.getElementById('username-input');
            const username = usernameInput.value;
            alert(`Username set as: ${username}`);
        }
    </script>
</body>
</html>
