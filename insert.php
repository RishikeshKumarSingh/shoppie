<?php include 'include/dbconfig.php';
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>

<body>
    <?php include 'include/header.php';
    ?>

    <div class='container mt-4'>
        <div class='row'>
            <div class='col-8 mx-auto'>
                <div class='card text-primary'>
                    <h3 class='mx-auto text-success'>Insert Form</h3>
                    <div class='col-10 ms-5'>
                        <form action='' method='post' enctype="multipart/form-data">
                            <div class='mb-3 mt-3 '>
                                <label for=''> Title</label>
                                <input type='text' name='title' class='form-control'>
                            </div>
                            <div class='mb-3'>
                                <label for=''>Category</label>
                                <select name='category' class='form-select'>
                                    <option value=''>Select category</option>
                                    <?php
                                    $callingcat = calling('category');
                                    foreach ($callingcat as $cat) {
                                        $id = $cat['cat_id'];
                                        $title = $cat['cat_title'];
                                        echo "<option value='$id'>$title</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label for=''>Image</label>
                                <input type='file' name='image' class='form-control'>
                            </div>
                            <div class='mb-3'>
                                <label for=''>Brand</label>
                                <input type='text' name='brand' class='form-control'>
                            </div>
                            <div class='mb-3'>
                                <label for=''>Price</label>
                                <input type='text' name='price' class='form-control'>
                            </div>
                            <div class='mb-3'>
                                <label for=''>Discount_price</label>
                                <input type='text' name='discount_price' class='form-control'>
                            </div>
                            <div class='mb-3'>
                                <label for=''>Description</label>
                                <input type='text' name='description' class='form-control'>
                            </div>

                            <div class='mb-3'>
                                <input type='submit' name='send' class='btn btn-warning'>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                if (isset($_POST['send'])) {
                  //image work
                   $image = $_FILES['image']['name'];
                   $temp_image = $_FILES['image']['tmp_name'];
                   move_uploaded_file($temp_image,"productimages/$image");

                    $data = [
                        'title' => $_POST['title'],
                        'category' => $_POST['category'],
                        'brand' => $_POST['brand'],
                        'price' => $_POST['price'],
                        'discount_price' => $_POST['discount_price'],
                        'description' => $_POST['description'],
                        'image' => $image,

                    ];
                    insertData('products', $data);
                    echo "<script>window.open('index.php','_self')</script>";
                }

                ?>
</body>

</html>