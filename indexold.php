<?php include "dbconfig.php";?>
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
<?php include "header.php";?>
   
               <div class="col-8 mt-4 mx-auto">
                   <table class="table table-bordered border-warning">
                       <tr>
                           <th>Id</th>
                           <th>Title</th>
                           <th>Category</th>
                           <th>Brand</th>
                           <th>Price</th>
                           <th>Image</th>
                           <th>Discount_price</th>
                          <th> Description</th>
                           <th>Action</th>
                           </tr>
                           <?php
                           $calling = calling("products");
                           foreach ($calling as $value){
                               ?>
                               <tr>
                               <td><?= $value['id'];?></td>
                               <td><?= $value['title'];?></td>
                               <td><?= $value['category'];?></td>
                               <td><?= $value['brand'];?></td>
                               <td><?= $value['price'];?></td>
                               <td><img src="productimages/<?= $value['image'];?>" width="50px" height="50px" alt=""></td>
                               <td><del class="text-danger"><?= $value['discount_price'];?></del></td>
                               <td><?= $value['description'];?></td>
                              
                               <td>
                               <a href="?del=<?= $value['id'];?>" class="btn btn-danger">Delete</a>
                               <a href="?del=<?= $value['id'];?>" class="btn btn-danger">Delete</a>
                               </td>
                           </tr>
                           <?php } ?>
                                  
                   </table>
               </div>
           </div>
       </div>
</body>
</html>
<?php
if(isset($_GET['del'])){
    $id = $_GET['del'];

    delete("products", "id='$id'");
    echo "<script>window.open('index.php','_self')</script>";
}
?>