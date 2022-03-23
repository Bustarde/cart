<?php
require('app/Customer.php');
require('app/Product.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>My Cart</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">
            <img src="logo.png" height="35">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="#" class="nav-item nav-link active">Home</a>
                <a href="#" class="nav-item nav-link active">About</a>
                <a href="#" class="nav-item nav-link active">Contact</a>
            </div>
        </div>
    </div>
</nav>

<div style="background: url(header1.png)" class="jumbotron bg-cover text-white">
    <div class="container py-5 text-center">
        <h1 class="display-4 font-weight-bold" style="color: green">Welcome <?php echo $customer->getName() ?>!</h1><br>
        <h2 class="font-italic mb-0" style="color: orange"><b>PRODUCTS</b></h2><br><br>
        <a href="shopping-cart.php">View Shopping Cart</a>
    </div>
</div>

<?php foreach ($products as $product): ?>
<form action="add-to-cart.php" method="POST">
  <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />
  
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="col d-flex justify-content-center">
        <div class="card mb-3" style="width: 800px; height: 190px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?php echo $product->getImage(); ?>" style="width: 800px; height: 188px;" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title"><?php echo $product->getName(); ?></h3>
                <p class="card-text" style="color: grey"><?php echo $product->getDescription(); ?></p>
                <p class="card-text" style="color: green">PHP <?php echo $product->getPrice(); ?></small></p>
                Qty. <input type="number" name="quantity" class="quantity" value="0" />
                <button type="submit" style="background-color: orange">ADD TO CART</button>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
</form>

<?php endforeach; ?>

</body>
</html>