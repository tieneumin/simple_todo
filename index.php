<?php
// Start session
session_start();

// 1. List database info e.g. DevKinsta Site Info 
$host = "devkinsta_db"; 
$database_name = "To_Do_List"; 
$database_user = "root";
$database_password = "in4VkcqsYWTIdopj"; 

// 2. Connect database to .php
$database = new PDO(
  "mysql:host=$host;dbname=$database_name",
  $database_user,
  $database_password
);
// var_dump($database);

// 3. Load database data
// 3.1 SQL command
$sql = "SELECT * FROM todos";
// 3.2 prepare SQL query 
$query = $database -> prepare($sql);
// 3.3 execute above query
$query -> execute();
// 3.4 fetch all data as per SELECT
$todos = $query -> fetchAll();
// var_dump($todos);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>To-Do List</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <?php if (isset($_SESSION["user"])): ?>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <h3 class="card-title mb-3"><?= $_SESSION["user"]["name"]; ?>'s To-Do List</h3>
          <a href="logout.php">Logout</a>
        </div>
        <ul class="list-group">
          <!-- loop start -->
          <?php foreach($todos as $todo): ?>
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
            >
              <div class="d-flex align-items-center">
                <!-- completion checkbox -->
                <form method="POST" action="complete_todo.php">
                  <input 
                      type="hidden"
                      name="todo_completed"
                      value="<?= $todo["completed"]; ?>" />
                  <input 
                      type="hidden"
                      name="todo_id"
                      value="<?= $todo["id"]; ?>" />
                  <!-- CSS A if 0, CSS B if 1 -->
                  <?php if ($todo["completed"] == 0): ?>
                    <button class="btn btn-sm btn-light">
                      <i class="bi bi-square"></i>
                    </button> 
                    <span class="ms-2">
                        <?= $todo["label"]; ?>
                    </span>
                  <?php else: ?>
                    <button class="btn btn-sm btn-success">
                      <i class="bi bi-check-square"></i>
                    </button>
                    <span class="ms-2 text-decoration-line-through">
                      <?= $todo["label"]; ?>
                    </span>
                  <?php endif; ?>
                </form>
              </div>
              <div>
                <!-- delete button -->
                <form method="POST" action="delete_todo.php">
                  <input 
                    type="hidden"
                    name="todo_id"
                    value="<?= $todo["id"]; ?>" />
                  <button class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </li>
          <?php endforeach; ?>
          <!-- loop end -->
        </ul>
        <div class="mt-4">
          <!-- add button -->
          <form method="POST" action="add_todo.php" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="todo_label"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>
    <?php else: ?>
      <div class="d-flex justify-content-center">
          <a href="login.php" class="btn btn-link" id="login">Login</a>
          <a href="signup.php" class="btn btn-link" id="signup">Sign Up</a>
      </div>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
