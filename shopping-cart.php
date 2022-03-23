<?php
require('app/Customer.php');
require('app/Product.php');
require('app/ShoppingCart.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');

$shoppingCart = new ShoppingCart($customer);
$shoppingCartItems = $shoppingCart->getAllItems();
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

<div style="background: url(header2.png)" class="jumbotron bg-cover text-white">
    <div class="container py-5 text-center">
        <h1 class="display-4 font-weight-bold" style="color: white">Welcome <?php echo $customer->getName() ?>!</h1><br>
        <h2 class="font-italic mb-0" style="color: orange"><b>SHOPPING CART</b></h2><br><br>
        <a href="products-list.php">Shop More Products</a>
    </div>
</div>

<?php if (count($shoppingCartItems) > 0): ?>

    <table>
    <thead>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
    </thead>
    <tbody>

    <?php foreach ($shoppingCartItems as $item): ?>

        <tr>
            <td><?php echo $item['product']->getName(); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['subtotal']; ?></td>
        </tr>

    <?php endforeach; ?>

        <tr>
            <td colspan="4">
                <?php echo $shoppingCart->getItemsTotal(); ?>
            </td>
        </tr>

    </tbody>
    </table>

    <?php endif; ?>

</body>
</html>