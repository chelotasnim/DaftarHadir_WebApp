<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/PwKLOi" method="POST">
        @csrf
        <label for="">Name</label>
        <br>
        <input type="text" name="name" required>
        <br>
        <br>
        <label for="">Username</label>
        <br>
        <input type="text" name="username" required>
        <br>
        <br>
        <label for="">Email</label>
        <br>
        <input type="email" name="email" required>
        <br>
        <br>
        <label for="">Password</label>
        <br>
        <input type="password" name="password">
        <br>
        <br>
        <button type="submit">Add</button>
    </form>
</body>
</html>