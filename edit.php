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

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$succesMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the client
    if (!isset($_GET["id"])) {
        header("location:index.php");
        exit;
    }
    $id = $_GET["id"];

    // read the row of the selected client from database table
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:index.php");
        exit;
    }
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
} else {
    //POST method: Update the date of the client
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are request";
            break;
        }
        $sql = "UPDATE clients
                SET name = '$name', email = '$email',phone = '$phone',address = '$address' WHERE id='$id'";

        $result = $mysqli->query($sql);

        if(!$result){
            $errorMessage = "Incaled query: " . $mysqli->error;
            break;
        }

        $succesMessage = "Client addet correctly";
        header("location:index.php");
        exit;

    } while (true);
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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
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