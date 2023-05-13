<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'Shop';

$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMassage = "";
$succesMassage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMassage = "All the fields are requerid";
            break;
        }
        // add new client to database

        $sql = "INSERT INTO clients(name,email,phone,address)
                VALUES ('$name','$email','$phone','$address')";
        $result = $mysqli->query($sql);

        if(!$result){
            die("Invaled query: " . $mysqli->error);
        }
            

        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $succesMassage = "Client addet correctly";

        header("location:index.php");
        exit;
    } while (false);
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <title>Copy Shop</title>
</head>

<body>
    <div class="container my-5">
        <div class="form-control">
            <h2>New Client</h2>
            <?php
            if (!empty($errorMassage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMassage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>

            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                    </div>
                </div>
                <?php
                if(!empty($succesMassage)){
                    echo "<div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-succes alert-dismissible fade show' role='alert'>
                        <strong>$succesMassage</strong>
                        <button class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>";
                }
                ?>
                
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a type="submit" class="btn btn-outline-primary" href="/ReapetCrud/index.php" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>