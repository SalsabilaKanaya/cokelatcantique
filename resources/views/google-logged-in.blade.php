<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Logged In</title>
</head>
<body>
    @if ($user== null)
        <h1>user tidak ditemukan</h1>
    @else
        <h1>Nama: {{ $user->name }}</h1>
        <h1>Email: {{ $user->email }}</h1>
    @endif
</body>
</html>