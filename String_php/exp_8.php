<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP String Operations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        h1 {
            color: #4A90E2;
            font-size: 2em;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049; /* Darker green */
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>String Operations</h1>
        <form method="POST">
            <input type="text" name="inputString" placeholder="Enter a string" required>
            <button type="submit">Process</button>
        </form>

        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $inputString = $_POST['inputString'];

                // String Length
                $length = strlen($inputString);

                // Substring
                $substring = substr($inputString, 0, 5); // First 5 characters

                // String Replacement
                $replacedString = str_replace(" ", "_", $inputString); // Replace spaces with underscores

                // String Concatenation
                $concatenatedString = $inputString . " - Concatenated";

                echo "<strong>Original String:</strong> $inputString<br><br>";
                echo "<strong>Length:</strong> $length characters<br>";
                echo "<strong>Substring (first 5 chars):</strong> $substring<br>";
                echo "<strong>Replaced String:</strong> $replacedString<br>";
                echo "<strong>Concatenated String:</strong> $concatenatedString<br>";
            }
            ?>
        </div>
    </div>
</body>
</html>
