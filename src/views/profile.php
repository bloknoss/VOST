<html lang="en">

<head>

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




    <script src="/js/funciones.js"></script>
</body>

</html>
<?php
