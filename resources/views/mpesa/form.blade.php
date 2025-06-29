<!DOCTYPE html>
<html>
<head>
    <title>M-Pesa Payment Form</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #e6f2ff; /* Light blue background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 500px; /* Adjust width as needed */
            max-width: 90%;
        }

        h1 {
            color: #3498db; /* Blue heading */
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50; /* Dark blue label */
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            box-sizing: border-box; /* Important for padding */
            font-size: 16px;
        }

        button {
            background-color: #3498db; /* Blue button */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pay with M-Pesa</h1>
        <form action="{{ route('mpesa.pay') }}" method="POST">
            @csrf
            <label>Transaction Reference:</label>
            <input type="text" name="transaction_reference" required>

            <label>Customer MSISDN (e.g., 25884XXXXXXX):</label>
            <input type="text" name="customer_msisdn" required>

            <label>Amount (MT):</label>
            <input type="number" name="amount" required>

            <label>Third Party Reference:</label>
            <input type="text" name="third_party_reference" required>

            <label>Service Provider Code:</label>
            <input type="text" name="service_provider_code" required>

            <button type="submit">Pay</button>
        </form>
    </div>
</body>
</html>