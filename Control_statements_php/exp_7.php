<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Control Statements</title>
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
            width: 300px;
        }

        h1 {
            color: #4A90E2;
            font-size: 2em;
            margin-bottom: 20px;
        }

        input[type="number"] {
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
        <h1>Control Statements</h1>
        <form method="POST">
            <input type="number" name="number" placeholder="Enter a number" required>
            <button type="submit">Check</button>
        </form>

        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $number = $_POST['number'];

                // Using if-else statement
                if ($number < 0) {
                    echo "The number is negative.";
                } elseif ($number == 0) {
                    echo "The number is zero.";
                } else {
                    echo "The number is positive.";
                }

                echo "<br><br>";

                // Using switch statement
                switch ($number) {
                    case 1:
                        echo "You entered one.";
                        break;
                    case 2:
                        echo "You entered two.";
                        break;
                    case 3:
                        echo "You entered three.";
                        break;
                    default:
                        echo "You entered a number greater than three.";
                        break;
                }

                echo "<br><br>";

                // Using for loop
                echo "Counting from 1 to $number: ";
                for ($i = 1; $i <= $number; $i++) {
                    echo $i . ($i < $number ? ", " : "");
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
