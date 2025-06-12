<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel Form Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f4f8fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .result-container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(42,77,105,0.10);
            padding: 40px 30px 32px 30px;
            text-align: center;
        }
        .greeting {
            color: #2a4d69;
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 18px;
        }
        .info {
            color: #41729f;
            font-size: 1.15em;
            margin-bottom: 10px;
        }
        .icon {
            font-size: 2.5em;
            color: #2a4d69;
            margin-bottom: 18px;
            display: inline-block;
        }
        .back-btn {
            display: inline-block;
            background:#2a4d69;
            color: #fff;
            border: none;
            padding: 4px 19px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .back-btn:hover {
            background:#41729f;
        }
        @media (max-width: 500px) {
            .result-container {
                padding: 24px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="result-container">
        <div class="icon">✈️</div>
        <?php
            $name = $_GET['name'];
            $destination = $_GET['destination'];
            if ($name && $destination) {
                echo "<div class='greeting'>Hello, $name!</div>";
                echo "<div class='info'>Get ready to explore <strong>$destination</strong>!</div>";

            } else {
                echo "<div class='greeting'>Please submit the form correctly.</div>";
            }
        ?>
        <a class='back-btn' href="form.html"> back </a>
    </div>
</body>
</html>
