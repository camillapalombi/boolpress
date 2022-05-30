<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Sei stato contattato ecco i dati:</h1>
    <p>Nome: {{ $lead->name }}</p>
    <p>Email: {{ $lead->email }}</p>
    <p>Messaggio: {{ $lead->message }}</p>
</body>
</html>
