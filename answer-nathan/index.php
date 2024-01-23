<?php

  // step 1: list out all the database info
  $host = 'mysql';
  $database_name = 'php_docker';
  $database_user = 'root';
  $database_password = 'secret';

  // Step 2: connect to the database to PHP
  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );

  // Step 3: load the data from the database
    // Step 3.1 - prepare the recipe & materials (SQL command)
    $sql = "SELECT * FROM todos";
    // 3.2 - pour everything into the bowl (prepare your database)
    $query = $database->prepare( $sql );
    // 3.3 - cook it (execute)
    $query->execute();
    // 3.4 - eat it (fetch all)
    $tasks = $query->fetchAll();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
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
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
          <?php foreach( $tasks as $task ) : ?>
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
              <?php if ( $task['completed'] == 1 ) : ?>
                <form
                  method="POST"
                  action="update_task.php"
                  >
                  <input
                    type="hidden"
                    name="task_completed"
                    value="0"
                    />
                  <input 
                    type="hidden"
                    name="task_id"
                    value="<?= $task['id']; ?>"
                    />
                  <button class="btn btn-sm btn-success">
                    <i class="bi bi-check-square"></i>
                  </button>
                </form>
                <span class="ms-2 text-decoration-line-through"><?= $task['label']; ?></span>
              <?php else : ?>
                <form
                  method="POST"
                  action="update_task.php"
                  >
                  <input
                    type="hidden"
                    name="task_completed"
                    value="1"
                    />
                  <input 
                    type="hidden"
                    name="task_id"
                    value="<?= $task['id']; ?>"
                    />
                  <button class="btn btn-sm btn-light">
                    <i class="bi bi-square"></i>
                  </button>
                </form>
                <span class="ms-2"><?= $task['label']; ?></span>
              <?php endif; ?>
            </div>
            <div>
              <form
                method="POST"
                action="delete_task.php">
                <input 
                  type="hidden"
                  name="task_id"
                  value="<?= $task['id']; ?>"
                  />
                <button class="btn btn-sm btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="mt-4">
          <form 
            method="POST"
            action="add_task.php"
            class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="task_name"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
