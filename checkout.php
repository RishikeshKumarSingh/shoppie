<?php include "include/dbconfig.php";
if (!isset($_SESSION['user'])) {
        redirect("auth/login.php");
}
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
                        <div class="col-8">
                                <div class="card">
                                        <div class="card-header">
                                                Enter The new address Details
                                        </div>
                                        <div class="card-body">
                                                <form action="" method="post">
                                                        <div class="row">
                                                                <div class="col-6">
                                                                        <div class="mb-3">
                                                                                <label for="">Name</label>
                                                                                <input type="text" name="name" class="form-control">
                                                                        </div>
                                                                </div>
                                                                <div class="col-6">
                                                                        <div class="mb-3">
                                                                                <label for="">Contact</label>
                                                                                <input type="text" name="contact" class="form-control">
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-6">
                                                                        <div class="mb-3">
                                                                                <label for="">Street</label>
                                                                                <input type="text" name="street" class="form-control">
                                                                        </div>
                                                                </div>
                                                                <div class="col-6">
                                                                        <div class="mb-3">
                                                                                <label for="">Locality</label>
                                                                                <input type="text" name="locality" class="form-control">
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col-4">
                                                                        <div class="mb-3">
                                                                                <label for="">Landmark</label>
                                                                                <input type="text" class="form-control" name="landmark">
                                                                        </div>
                                                                </div>
                                                                <div class="col-4">
                                                                        <div class="mb-3">
                                                                                <label for="">District</label>
                                                                                <input type="text" class="form-control" name="district">
                                                                        </div>
                                                                </div>
                                                                <div class="col-4">
                                                                        <div class="mb-3">
                                                                                <label for="">State</label>
                                                                                <input type="text" class="form-control" name="state">
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col">
                                                                        <div class="mb-3">
                                                                                <label for="">Pincode</label>
                                                                                <input type="text" name="pincode" class="form-control">
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                                <div class="col">
                                                                        <div class="mb-3">    
                                                                                <input type="submit" class="btn btn-success w-100" name="new_address">
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </form>
                                                <?php
                                                if(isset($_POST['new_address'])) {
                                                        $log = $_SESSION['user'];
                                                        $user = callingOne("users where email='$log' OR password='$log'");
                                                        $user_id = $user['user_id'];

                                                        $data = [

                                                                'name' => $_POST['name'],
                                                                'contact' => $_POST['contact'],
                                                                'street' => $_POST['street'],
                                                                'district' => $_POST['district'],
                                                                'state' => $_POST['state'],
                                                                'locality' => $_POST['locality'],
                                                                'landmark' => $_POST['landmark'],
                                                                'pincode' => $_POST['pincode'],
                                                                'user_id' => $user_id,
                                                        ];

                                                        insertData("address",$data);
                                                        redirect("checkout.php");
                                                }
                                                 ?>
                                        </div>
                                </div>
                        </div>
                        <div class="col-4">
                                <h6 class="lead">Saved Address</h6>
                                <hr>
                                <?php  $log= $_SESSION['user'];
                                $user = callingOne("users where email='$log' OR password='$log'");
                                $user_id =$user['user_id'];

                                $callingAddress= calling ("address where user_id='$user_id'");
                                foreach ($callingAddress as $value){
                                        ?>
                                <div class="card mb-3">
                                        <div class="card-body">
                                                <h6><?= $value['name'];?>(<?= $value['contact'];?>)</h6>
                                                <p class="small m-0 p-0"><?= $value['landmark'];?></p>
                                                <p class="small m-0 p-0"><?= $value['street'];?>,<?= $value['locality'];?>,<?= $value['district'];?>(<?= $value['state'];?>
                                                ) - <?= $value['pincode'];?></p>
                                                <a href="" class="btn btn-info btn-sm mt-3">Use this Address</a>
                                        </div>
                                </div>
                                <?php } ?>
                        </div>
                </div>
        </div>

</body>

</html>