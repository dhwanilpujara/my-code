<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Way</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #choose-way-container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .options-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .option-btn {
            background-color: #3498db;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .option-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div id="choose-way-container">
        <h1>Choose Your Way</h1>
        <div class="options-container">
            <button class="option-btn" onclick="chooseOption('Text')">Text</button>
            <button class="option-btn" onclick="chooseOption('Audio')">Audio</button>
            <button class="option-btn" onclick="chooseOption('Video')">Video</button>
        </div>
    </div>

    <script>
        function chooseOption(option) {
            alert(`You chose: ${option}`);
        }
    </script>
</body>
</html>
