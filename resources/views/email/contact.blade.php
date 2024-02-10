<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Mail</title>
</head>
<body>
    <h3>Bonjour Monsieur,</h3>
    <p>
        Vous avez un message de contact de la part de Mr/Mlle <h3>{{ $mailcontact['name'] }}</h3> .
    </p>
    <hr>
    <h4><u>Objet:</u></h4>
    <p>{{ $mailcontact['object'] }}</p>
    <hr>
    <h4><u>Contenu du message:</u></h4>
    <p>{{ $mailcontact['message'] }}</p>
     <hr>
    <h4>Email de Mr/Mlle {{ $mailcontact['name'] }}:</h4>
    <p>{{ $mailcontact['message'] }}</p>

    <p class="text-center">VShop</p>
</body>
</html>