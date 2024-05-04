<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMC</title>

    <link rel="stylesheet" href="base.css">

    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Link -->


    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Font Awesome Cdn -->


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <!-- Google Fonts -->
</head>

<body>
    <style>
        /* Navbar Start */
#navbar{
    background: #f9f9f9;
}
#logo{
    font-size: 36px;
    font-weight: 550;
    color: black;
    text-shadow: 0px 1px 1px black;
    margin-bottom: 5px;
}
#logo span{
    color: #ffa500;
}
.navbar-toggler span{
    color: #ffa500;
}
.navbar-nav{
    margin-left: 20px;
}
.nav-item .nav-link{
    font-size: 16px;
    font-weight: 550;
    color: black;
    letter-spacing: 1px;
    border-radius: 3px;
    transition: 0.5s ease;
}
.nav-item .nav-link:hover{
    background: #ffa500;
    color: white;
}
#navbar form button{
    background: orange;
    color: white;
    border: none;
}
/* Navbar End */
    </style>





    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
          <a class="navbar-brand" href="index.html" id="logo"><span>S</span>MC</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span><i class="fa-solid fa-bars"></i></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Sewing Machines</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Spare Parts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">About</a>
              </li>
             
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="text" placeholder="Search">
              <button class="btn btn-primary" type="button">Search</button>
            </form>
          </div>
        </div>
      </nav>
    <!-- Navbar End -->
<header class="header">

<link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 

<div class="flex">
<a href="#" class="logo">Adding a Product?</a>
<?php
  $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
  $row_count = mysqli_num_rows($select_rows);


?>
<nav class="navbar">
    <a href="admin.php">Add Products</a>
    <a href="product.php">View Products</a>
</nav>
<a href="cart.php" class="cart"> Cart <span><?php echo $row_count?></span></a>

<div id="list-btn" class="fas fa-bars"></div>
    
</div>

</div>


</header>