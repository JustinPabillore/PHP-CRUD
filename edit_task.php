<?php session_start();
include ("config.php");

$ID = $_GET['ID'];
if(isset($_POST["backButton"])){
    header("Location: index.php");
    exit();
}
if(isset($_POST["updateButton"])){

    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $Priority = $_POST['Priority'];
    $Due_Date = $_POST['Due_Date'];


    $query = "UPDATE `tasks` SET `Title`='$Title',`Description`='$Description',`Priority`='$Priority',`Due_Date`='$Due_Date' 
    WHERE ID = $ID";
    
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Task Updated!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }else{
        $_SESSION['status'] = "Edit Failed";
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

<h1 class="text-center mt-5">Update Task</h1>
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
                        <input type="text" class="form-control" name="Title" value="<?php echo $row['Title'] ?>">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control" style="height: 150px;" name="Description"><?php echo $row['Description'] ?></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="Priority" class="form-label">Priority</label>
                        <select id="Priority" name="Priority">
                            <option value="Low" <?php if ($row['Priority'] == 'Low') echo 'selected'; ?>>Low</option>
                            <option value="Medium" <?php if ($row['Priority'] == 'Medium') echo 'selected'; ?>>Medium</option>
                            <option value="High" <?php if ($row['Priority'] == 'High') echo 'selected'; ?>>High</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="Due_Date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" name="Due_Date" value="<?php echo $row['Due_Date'] ?>">
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <button type="back" class="btn btn-danger" name="backButton" style="float: left;">Back</button>
                        <button type="submit" class="btn btn-primary" name="updateButton" style="float: right;">Update</button>
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
