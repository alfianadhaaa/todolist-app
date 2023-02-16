<?php include("db.php"); ?>

<?php
    if(isset($_POST['add_post'])) {
        $task_name = mysqli_real_escape_string($connection,$_POST['task_name']);
        $query = mysqli_query($connection, "INSERT INTO tasks (task_name, task_status, task_date) VALUES ('$task_name', 'pending', now())");
        header("location: index.php");
    }

    if(isset($_GET['edit'])) {
        $task_id = $_GET['edit'];
        $query = mysqli_query($connection, "UPDATE tasks SET task_status = 'Selesai' WHERE task_id = '$task_id'");
        header("location: index.php");
    }

    if(isset($_GET['delete'])) {
        $task_id = $_GET['delete'];
        $query = mysqli_query($connection, "DELETE FROM tasks WHERE task_id = '$task_id'");
        header("location: index.php");
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TODOLIST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">TODOLIST-APP</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h3>Form Tambah Tugas</h3>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="task_name" placeholder="Input Nama Tugas">
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" name="add_post"
                                    class="btn btn-primary btn-block form-control">Tambah
                                    Tugas</button>
                            </div>
                        </form>
                        <h3 class="mt-3">List Pending Tugas</h3>
                        <ul class="list-group">
                            <?php 
                                $query = mysqli_query($connection, "SELECT * FROM tasks WHERE task_status = 'pending'");
                                while($row = mysqli_fetch_array($query)) {
                                    $task_id = $row['task_id'];
                                    $task_name = $row['task_name'];
                                
                            ?>
                            <li class="list-group-item">
                                <?php echo $task_name; ?>
                                <div class="float-end">
                                    <a href="index.php?edit=<?php echo $task_id ?>" class="btn btn-info"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Tandai Sudah Selesai">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                        </svg>
                                    </a>

                                    <a href="index.php?delete=<?php echo $task_id ?>" class="btn btn-danger"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hapus Tugas">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </a>
                                </div>

                            </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <h3>List Tugas Selesai</h3>
                        <ul class="list-group">
                            <?php 
                                $query = mysqli_query($connection, "SELECT * FROM tasks WHERE task_status = 'Selesai'");
                                while($row = mysqli_fetch_array($query)) {

                            ?>
                            <li class="list-group-item">
                                <?php echo $row['task_name'];?>
                                <div class="float-end">
                                    <span class="badge text-bg-primary"><?php echo $row['task_status']; ?></span>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>