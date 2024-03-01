<?php session_start();
include ("config.php");
if(isset($_POST["backButton"])){
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="text-center mt-5">View Task</h1>
<div class="container mt-4">
    <?php
    $ID = $_GET['ID'];
    $query = "SELECT * FROM `tasks` WHERE ID = $ID LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    ?>
    <div class="row justify-content-center">  
        <div class="col-lg-9">
        <form action="edit_task.php?ID=<?php echo $row['ID']; ?>" method="POST">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="Title" class="form-label">Title</label>
                        <input class="form-control" name="Title" value="<?php echo $row['Title'] ?>"readonly>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control"name="Description" style="height: 200px;" readonly><?php echo $row['Description'] ?></textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="Priority" class="form-label">Priority</label>
                        <input class="form-control" name="Priority" value="<?php echo $row['Priority'] ?>"readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="Due_Date" class="form-label">Due Date</label>
                        <input class="form-control" name="Due_Date" value="<?php echo $row['Due_Date'] ?>"readonly>
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <button type="back" class="btn btn-danger" name="backButton" style="float: left;">Back</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if (isset($_SESSION['status']) && $_SESSION['status_code'] != '' )
{
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
        });
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}
?>
</body>
</html>
