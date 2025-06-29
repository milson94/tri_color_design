<!DOCTYPE html>
<html>
<head>
    <title>Payment Result</title>
</head>
<body>
    <h1>Payment Status: {{ $status }}</h1>
    <pre>{{ json_encode($json, JSON_PRETTY_PRINT) }}</pre>
</body>
</html>
