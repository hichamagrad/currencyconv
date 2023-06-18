<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-top: 0;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: red;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: black;
        }

        p.result {
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Currency Converter</h1>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="amount">Amount:</label>
            <input type="number" step="0.01" name="amount" required><br><br>

            <label for="from_currency">From Currency:</label>
            <select name="from_currency" required>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="MAD">MAD</option>
            </select><br><br>

            <label for="to_currency">To Currency:</label>
            <select name="to_currency" required>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="MAD">MAD</option>
            </select><br><br>

            <input type="submit" value="Convert">
        </form>

        <div id="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Define the conversion rates
                $usd_to_eur = 0.85;
                $usd_to_gbp = 0.72;
                $usd_to_mad = 9.28;

                $amount = $_POST["amount"];
                $from_currency = $_POST["from_currency"];
                $to_currency = $_POST["to_currency"];

                $converted_amount = 0;

                if ($from_currency === "USD") {
                    if ($to_currency === "EUR") {
                        $converted_amount = $amount * $usd_to_eur;
                    } elseif ($to_currency === "GBP") {
                        $converted_amount = $amount * $usd_to_gbp;
                    } elseif ($to_currency === "MAD") {
                        $converted_amount = $amount * $usd_to_mad;
                    }
                } elseif ($from_currency === "EUR") {
                    if ($to_currency === "USD") {
                        $converted_amount = $amount / $usd_to_eur;
                    } elseif ($to_currency === "GBP") {
                        $converted_amount = ($amount / $usd_to_eur) * $usd_to_gbp;
                    } elseif ($to_currency === "MAD") {
                        $converted_amount = ($amount / $usd_to_eur) * $usd_to_mad;
                    }
                } elseif ($from_currency === "GBP") {
                    if ($to_currency === "USD") {
                        $converted_amount = $amount / $usd_to_gbp;
                    } elseif ($to_currency === "EUR") {
                        $converted_amount = ($amount / $usd_to_gbp) * $usd_to_eur;
                    } elseif ($to_currency === "MAD") {
                        $converted_amount = ($amount / $usd_to_gbp) * $usd_to_mad;
                    }
                } elseif ($from_currency === "MAD") {
                    if ($to_currency === "USD") {
                        $converted_amount = $amount / $usd_to_mad;
                    } elseif ($to_currency === "EUR") {
                        $converted_amount = ($amount / $usd_to_mad) * $usd_to_eur;
                    } elseif ($to_currency === "GBP") {
                        $converted_amount = ($amount / $usd_to_mad) * $usd_to_gbp;
                    }
                }

                echo "<p class='result'>$amount $from_currency = $converted_amount $to_currency</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
