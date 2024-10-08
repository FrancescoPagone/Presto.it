<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Ciao Admin<i class="fas fa-user ms-2"></i></h1>
        <h2 class="text-center">Ecco i suoi dati:</h2>
        <div class="card">
            <div class="card-body">
                <p><i class="fas fa-user-circle"></i> Nome: {{ $user->name }}</p>
                <p><i class="fas fa-envelope"></i> Email: {{ $user->email }}</p>
                <p><i class="fas fa-info-circle"></i> Descrizione: {{ $description }}</p>
                <p><i class="fas fa-share-square"></i> Se vuoi renderlo revisore clicca sul link:</p>
                <a href="{{ route('make.revisor', compact('user')) }}" class="btn btn-primary">Rendi Revisore <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</body>

</html>
