<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food-order1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = htmlspecialchars($_POST['full-name']);
    $contact = htmlspecialchars($_POST['contact']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $quantity = intval($_POST['qty']);
    $foodTitle = "Food Title"; // This can be dynamic if fetching from a database
    $price = 2.3;
    $totalPrice = $price * $quantity;

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (full_name, contact, email, address, food_title, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssid", $fullName, $contact, $email, $address, $foodTitle, $quantity, $totalPrice);

    if ($stmt->execute()) {
        echo "<script>alert('Order Confirmed! Thank you, $fullName.');</script>";
    } else {
        echo "<script>alert('Error placing order. Please try again.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Order</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/bestpica-removebg-preview.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="foods.php">Foods</a></li>
                    <li><a href="index.php">Contact</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    <div class="food-menu-img">
                        <img src="images/menu-pizza.jpg" alt="Pizza" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h3>Food Title</h3>
                        <p class="food-price">$2.3</p>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Artiol Thaqi" class="input-responsive" required>
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@artiolthaqi.com" class="input-responsive" required>
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>

    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Artiol Thaqi</a></p>
        </div>
    </section>
    <style>
        

*{
    margin: 0 0;
    padding: 0 0;
    font-family: Arial, Helvetica, sans-serif;
}
.container{
    width: 80%;
    margin: 0 auto;
    padding: 1%;
}
.img-responsive{
    width: 100%;
}
.img-curve{
    border-radius: 15px;
}

.text-right{
    text-align: right;
}
.text-center{
    text-align: center;
}
.text-left{
    text-align: left;
}
.text-white{
    color: white;
}

.clearfix{
    clear: both;
    float: none;
}

a{
    color: #ff6b81;
    text-decoration: none;
}
a:hover{
    color: #ff4757;
}

.btn{
    padding: 1%;
    border: none;
    font-size: 1rem;
    border-radius: 5px;
}
.btn-primary{
    background-color: #ff6b81;
    color: white;
    cursor: pointer;
}
.btn-primary:hover{
    color: white;
    background-color: #ff4757;
}
h2{
    color: #2f3542;
    font-size: 2rem;
    margin-bottom: 2%;
}
h3{
    font-size: 1.5rem;
}
.float-container{
    position: relative;
}
.float-text{
    position: absolute;
    bottom: 50px;
    left: 40%;
}
fieldset{
    border: 1px solid white;
    margin: 5%;
    padding: 3%;
    border-radius: 5px;
}


/* CSSS for navbar section */

.logo{
    width: 10%;
    float: left;
}
.menu{
    line-height: 60px;
}
.menu ul{
    list-style-type: none;
}

.menu ul li{
    display: inline;
    padding: 1%;
    font-weight: bold;
}


/* CSS for Food SEarch Section */

.food-search{
    background-image: url(images/bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    padding: 7% 0;
}

.food-search input[type="search"]{
    width: 50%;
    padding: 1%;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
}


/* CSS for Categories */
.categories{
    padding: 4% 0;
}

.box-3{
    width: 28%;
    float: left;
    margin: 2%;
}


/* CSS for Food Menu */
.food-menu{
    background-color: #ececec;
    padding: 4% 0;
}
.food-menu-box{
    width: 43%;
    margin: 1%;
    padding: 2%;
    float: left;
    background-color: white;
    border-radius: 15px;
}

.food-menu-img{
    width: 20%;
    float: left;
}

.food-menu-desc{
    width: 70%;
    float: left;
    margin-left: 8%;
}

.food-price{
    font-size: 1.2rem;
    margin: 2% 0;
}
.food-detail{
    font-size: 1rem;
    color: #747d8c;
}


/* CSS for Social */
.social ul{
    list-style-type: none;
}
.social ul li{
    display: inline;
    padding: 1%;
}

/* for Order Section */
.order{
    width: 50%;
    margin: 0 auto;
}
.input-responsive{
    width: 96%;
    padding: 1%;
    margin-bottom: 3%;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
}
.order-label{
    margin-bottom: 1%; 
    font-weight: bold;
}



/* CSS for Mobile Size or Smaller Screen */

@media only screen and (max-width:768px){
    .logo{
        width: 80%;
        float: none;
        margin: 1% auto;
    }

    .menu ul{
        text-align: center;
    }

    .food-search input[type="search"]{
        width: 90%;
        padding: 2%;
        margin-bottom: 3%;
    }

    .btn{
        width: 91%;
        padding: 2%;
    }

    .food-search{
        padding: 10% 0;
    }

    .categories{
        padding: 20% 0;
    }
    h2{
        margin-bottom: 10%;
    }
    .box-3{
        width: 100%;
        margin: 4% auto;
    }

    .food-menu{
        padding: 20% 0;
    }

    .food-menu-box{
        width: 90%;
        padding: 5%;
        margin-bottom: 5%;
    }
    .social{
        padding: 5% 0;
    }
    .order{
        width: 100%;
    }
}

    </style>
</body>
</html>