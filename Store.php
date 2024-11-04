<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            background-image: url("images/bg.png");
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .nav-link {
            color: white;
        }

        .catalog {
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .catalog h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(9px);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card-body {
            background-color: transparent;
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .card-text {
            font-size: 14px;
            color: lightgray;
        }

        .card-price {
            font-size: 16px;
            font-weight: bold;
            color: #ff9900;
        }

        .card-button {
            background-color: #ff9900;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color:white;
            cursor: pointer;
            border-radius: 5px;
        }

        .row {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Game Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="Home.html">Home</a>
                    </li>
                    <!-- <li class="nav-item"> -->
                        <!-- <a class="nav-link" href="p0/login.html">Login</a> -->
                    <!-- </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="Cart.html">Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="catalog">
        <div class="container">
            <h2>Shop Games Now</h2>
            <div class="row" id="games-list">
                <!-- Game cards will be dynamically added here -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
    <script>
        // Function to add an item to the cart
        function addToCart(title, description, price) {
            var cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            cartItems.push({ title: title, description: description, price: price });
            localStorage.setItem('cart', JSON.stringify(cartItems));
            updateCartTotal();
        }

        // Function to update the cart total
        function updateCartTotal() {
            var cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            var cartTotal = 0;
            cartItems.forEach(function (item) {
                cartTotal += parseFloat(item.price.replace('$', ''));
            });
            document.getElementById('cart-total').textContent = '$' + cartTotal.toFixed(2);
        }

        $(document).ready(function () {
            displayGames();

            // Load cart total on page load
            updateCartTotal();

            function displayGames() {
                var games = [
                    { title: "GTA 5", description: "Grand Theft Auto V for PC offers players the option to explore the award-winning world of Los Santos and Blaine County in resolutions of up to 4k and beyond, as well as the chance to experience the game running at 60 frames per second.", price: "15.99", image: "images/GTA 5.jpg"},
                    { title: "Days Gone", description: "Ride and fight into a deadly, post pandemic America. Play as Deacon St. John, a drifter and bounty hunter who rides the broken road, fighting to survive while searching for a reason to live in this open-world action-adventure game.", price: "14.99", image: "images/Days Gone.jpg"},
                    { title: "Elden Ring", description: "THE NEW FANTASY ACTION RPG. Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between..", price: "39.99", image: "images/Elden Ring.jpg", name:"cart_items"},
                    { title: "Dark Souls III", description: "Dark Souls continues to push the boundaries with the latest, ambitious chapter in the critically-acclaimed and genre-defining series. Prepare yourself and Embrace The Darkness!", price: "49.99", image: "images/Dark Souls III.jpg"},
                    { title: "Spider Man", description: "In Marvel’s Spider-Man Remastered, the worlds of Peter Parker and Spider-Man collide in an original action-packed story. Play as an experienced Peter Parker, fighting big crime and iconic villains in Marvel’s New York. Web-swing through vibrant neighborhoods and defeat villains with epic", price: "24.99", image: "images/Spiderman.jpg"},
                    { title: "Star Wars", description: "The story of Cal Kestis continues in STAR WARS Jedi: Survivor™, a galaxy-spanning, third-person, action-adventure game.", price: "29.99", image: "images/Jedi.jpg"}
                ];

                var gamesList = $("#games-list");
                gamesList.empty();

                $.each(games, function (index, game) {
                    var card = '<div class="col-lg-4 col-md-6 col-sm-12">' +
                        '<div class="card">' +
                        '<img src="' + game.image + '" class="card-img-top" alt="' + game.title + '">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + game.title + '</h5>' +
                        '<p class="card-text">' + game.description + '</p>' +
                        '<p class="card-price">$' + parseFloat(game.price).toFixed(2) + '</p>' +
                        '<button type="submit" class="btn btn-primary" onclick="addToCart(\'' + game.title + '\', \'' + game.description + '\', \'' + game.price + '\')"><span class="material-icons">shopping_cart</span> Add to Cart</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    gamesList.append(card);
                });
            }
        });
    </script>
</body>

</html>

