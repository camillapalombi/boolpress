<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Ciao {{ $lead->name }}, il tuo messaggio è stato ricevuto</p>
    <p>A breve verrai contattato su {{ $lead->email }}</p>

    <h3>Messaggio originale</h3>
    <p>{{ $lead->message }}</p>

    <h1>Grazie!</h1>
</body>
</html>
