<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/signin" method="post">
    <label for="name">
        User name
        <input type="text" name="name" id="name">
    </label>
    <label for="email">
        Email
        <input type="email" name="email" id="email">
    </label>
    <label for="password">
        Password
        <input type="password" name="password" id="password">
    </label>
    <button type="submit">
        Create
    </button>
</form>
</body>
</html>
<?php
