<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
                <a href="" class="navbar-brand"><b>Shoppie</b></a>
                <form action="index.php" class="d-flex input-group w-50">
                        <input type="search" name="search" class="form-control">
                        <input type="submit" name="find" class="btn btn-success">
                </form>
                <ul class="navbar-nav">
                        <li class="nav-item"><a href="index.php" class="nav-link text-info"><b>Index</b></a></li>


                        <?php if (isset($_SESSION['user'])) { ?>
                                <li class="nav-item"><a href="auth/login.php" class="nav-link text-info"><b>Logout</b></a></li>
                                <li class="nav-item"><a href="auth/login.php" class="nav-link text-info"><b>
                                        <?php 
                                        $log =$_SESSION['user'];
                                        $data = calling("users where email='$log' OR contact='$log'");
                                        echo $fullname=$data[0]['fullname'];
                                        ?>
                                </b></a></li>
                                <li class="nav-item"><a href="insert.php" class="nav-link text-info"><b>Insert</b></a></li>


                        <?php } else { ?>
                                <li class="nav-item"><a href="auth/login.php" class="nav-link text-info"><b>Login</b></a></li>
                                <li class="nav-item"><a href="auth/signup.php" class="nav-link text-info"><b>Signup</b></a></li>
                                
                        <?php } ?>
                        <li class="nav-item"><a href="cart.php" class="btn btn-warning btn-sm mt-1 position-relative"><i class="bi bi-cart"></i><b>Cart</b>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                99+
                                        </span>
                                </a>
                        </li>
                </ul>
        </div>
</nav>

</nav>