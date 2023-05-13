<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Copy Shop</title>
</head>

<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <button class="btn btn-primary" \role="button"><a href="/ReapetCrud/create.php" style="color:aliceblue">Add New CLient</a></button>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Creadet At</th>
                    </tr>
                </thead>
                <tbody>
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
                    $sql = "SELECT * FROM clients";
                    $result = $mysqli->query($sql);

                    if(!$result){
                        die ("Invalid query: " . $mysqli->error);
                    }
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a href='edit.php?id=$row[id]' type='button' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='delete.phpid=$row[id]' type='button' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>