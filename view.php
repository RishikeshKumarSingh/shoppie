<?php include "include/dbconfig.php";

if (!isset($_GET['id'])) {
        redirect("index.php");
}
$ID = $_GET['id'];
$callingRecord = calling("products JOIN category ON products.category=category.cat_id where id='$ID'");
$row = $callingRecord[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body>
        <?php include "include/header.php"; ?>

        <div class="container mt-4">
                <div class="row">
                        <div class="col-3">
                                <?php include "include/side.php"; ?>
                        </div>
                        <div class="col-9 mt-3">
                                <div class="row">
                                        <div class="col-4">
                                                <img src="productimages/<?= $row['image']; ?>" alt="" class="card-img-top">
                                        </div>
                                        <div class="col-8">
                                                <table class="table">
                                                        <tr>
                                                                <th><?= $row['title']; ?></th>
                                                        </tr>
                                                        <tr>
                                                                <th>MRP</th>
                                                                <td><del><?= $row['price']; ?></del></td>
                                                        </tr>
                                                        <tr>
                                                                <th>Brand</th>
                                                                <td><?= $row['brand']; ?></td>
                                                        </tr>
                                                        <tr>
                                                                <th>Category</th>
                                                                <td><?= $row['cat_title']; ?></td>
                                                        </tr>
                                                        <tr>
                                                                <th>Offer Price</th>
                                                                <td>
                                                                        <h4>Rs.<?= $row['discount_price']; ?></h4>
                                                                </td>
                                                        </tr>
                                                </table>
                                                <a href="view.php?p_id=<?= $row['id']; ?>&id=<?= $_GET['id']; ?>" class="btn btn-warning"><i class="bi bi-cart"></i>Add to Cart</a>
                                                <a href="" class="btn btn-success"><i class="bi bi-bag"></i>Buy Now</a>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>

</body>

</html>
<?php
if (isset($_GET['p_id'])) {
        //reterive product details
        $p_id = $_GET['p_id'];
        $product = callingOne("products where id='$p_id'");
        $product_id = $product['id'];

        //reterive user data
        $log = $_SESSION['user'];
        $user = callingOne("users where email='$log' OR contact='$log'");


        if ($product) {
                //reterive order details
                echo $user_id = $user['user_id'];
                $order = callingOne("orders where ordered=0 AND user_id='$user_id'");

                if ($order) {
                        //order item deatails
                        $orderItem = callingOne("order_item where user_id='$user_id' AND product_id='$product_id' AND ordered=0");

                        if ($orderItem) {
                                $orderitem_id = $orderItem['orderitem_id'];
                                $updateQuery = mysqli_query($connect, "update order_item SET qty=qty+1 where orderitem_id='$orderitem_id'");
                        } else {
                                $insertData = [
                                        'ordered' => 0,
                                        'user_id' => $user_id,
                                        'product_id' => $product_id,
                                        'order_id' => $order['id'],
                                        'qty' => 1
                                ];
                                insertData("order_item", $insertData);
                                //redirect
                        }
                } 
                else {
                        $insertOrder = [
                                'ordered' => 0,
                                'user_id' => $user_id,
                        ];
                        insertData("orders", $insertOrder);

                        $lastId = mysqli_insert_id($connect);
                        $insertData = [
                                'ordered' => 0,
                                'user_id' => $user_id,
                                'product_id' => $product_id,
                                'order_id' => $lastId,
                                'qty' => 1
                        ];
                        insertData("order_item", $insertData);
                }
        }
        redirect("cart.php");
}
?>