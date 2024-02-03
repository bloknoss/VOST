<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Info</title>
    <style>
        * {
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
        }

        #editForm {
            display: none;
        }

        .container {
            width: 100%;
            height: 30vh;
            background: #464450;
            color: whitesmoke;
            border-radius: 1rem;
            padding: 2rem;
            display: flex;
            flex-flow: column;
            align-content: space-between;
        }

        button {
            background: #28a745;
            height: 3rem;
            padding: 1rem;
            border-radius: 0.5rem;
            color: whitesmoke;
            border: none;
        }

        input {
            height: 3rem;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }

        div h2 {
            color: lightgrey;
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        <h1>Your Profile</h1>
        <h2>User Name : <?= $_SESSION["user"]->name ?></h2>
        <h2>User Email : <?= $_SESSION["user"]->email ?></h2>
    </div>
    <div>
        <form action="/user/edit" method="post" id="editForm" target="">
            <label for="userName">User Name
                <input type="text" name="userName" id="userName" value="<?= $_SESSION["user"]->name ?>">
            </label>
            <label for="email">Email
                <input type="email" name="email" id="email" value="<?= $_SESSION["user"]->email ?>">
            </label>
            <button type="submit">
                Save
            </button>
        </form>
        <button onclick="edit()">
            Edit
        </button>

    </div>
    <div id="orders">
        <button onclick="getOrders()">
            See orders
        </button>

    </div>
</div>




<script>
    function getOrders(){
        fetch('http://localhost:80/user/orders' )
            .then(data => data.text())
            .then(response => {
                console.log(response)
                document.getElementById('orders').innerHTML += response
            })
    }
    function edit() {
        document.getElementById('editForm').style.display = 'flex'
    }
</script>
</body>
</html>
<?php
