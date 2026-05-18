<?php

$servername = "db"; 
$username = "root";
$password = "root"; 
$dbname = "dict"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed1: " . $conn->connect_error);
}
// Note: You might want to remove or comment out the next line in production so it doesn't print on the page!
echo "DB Connected Successfully";

$word = "";
$definition = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = $_POST["word"];

    $stmt = $conn->prepare("SELECT def FROM mywords WHERE word = ?");
    $stmt->bind_param("s", $word);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $definition = $row["def"];
    } else {
        $definition = "Word not found in the dictionary.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary</title>
    <style>
        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background-color: #f7f9fc;
            color: #333;
            margin: 0;
            padding: 40px 20px;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #2d3748;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            width: 100%;
            margin: 0 auto 30px;
            padding: 30px 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 12px;
            font-size: 18px;
            color: #4a5568;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
        }

        button {
            padding: 12px 24px;
            background: #4299e1;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background: #3182ce;
        }

        h2 {
            font-size: 20px;
            color: #2d3748;
            margin: 10px 0 15px;
        }

        p {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            padding: 24px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            font-size: 16px;
            line-height: 1.6;
            color: #4a5568;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>My Dictionary</h1>
    <form method="POST" action="">
        <label for="word">Enter a word:</label>
        <input type="text" id="word" name="word" required>
        <button type="submit">Go</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>Data:</h2>
        <p><?php echo htmlspecialchars($definition); ?></p>
    <?php endif; ?>
</body>
</html>