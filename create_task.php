<?php session_start();
include ("config.php");

if(isset($_POST["backButton"])){
    header("Location: index.php");
    exit();
}
if(isset($_POST["submitButton"])){
if(empty($_POST['Title']) || empty($_POST['Description']) || empty($_POST['Priority']) || empty($_POST['Due_Date'])){
    $_SESSION['status'] = "Please fill in all required fields";
    $_SESSION['status_code'] = "error";
    header("Location: create_task.php");
    exit();
}

$Title = $_POST['Title'];
$Description = $_POST['Description'];
$Priority = $_POST['Priority'];
$Due_Date = $_POST['Due_Date'];

$query = "INSERT INTO `tasks`(`Title`, `Description`, `Priority`, `Due_Date`) 
VALUES ('$Title','$Description','$Priority','$Due_Date')";
$query_result = mysqli_query( $con, $query );

if($query_result){
    $_SESSION['status'] = "Task Added!";
    $_SESSION['status_code'] = "success";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['status'] = "Error: " . mysqli_error($con);
    $_SESSION['status_code'] = "error";
    header("Location: index.php");
    exit();
}
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

<h1 class="text-center mt-5">Insert Task</h1>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <form action="create_task.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="Title" class="form-label">Title</label>
                        <input type="text" placeholder="Enter Task Title" class="form-control" name="Title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea placeholder="Enter Task Description" style="height: 150px;" class="form-control" name="Description"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="Priority" class="form-label">Priority</label>
                        <select id="Priority" name="Priority">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Due_Date" class="form-label">Due Date</label>
                        <input type="date" placeholder="Enter Due Date" class="form-control" name="Due_Date">
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <button type="back" class="btn btn-danger" name="backButton" style="float: left;">Back</button>
                        <button type="submit" class="btn btn-primary" name="submitButton" style="float: right;">Insert</button>
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