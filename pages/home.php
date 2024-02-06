<?php
  $database = connectToDB();
  
  // fetch all todos of user via placeholder query (security)
  $sql = "SELECT * FROM todos WHERE user_id = :user_id";
  $query = $database -> prepare($sql);
  $query -> execute([
    "user_id" => isset($_SESSION["user"]["id"])? $_SESSION["user"]["id"]: ""
  ]);
  $todos = $query -> fetchAll(); // fetch all rows
  // var_dump($todos);

  require "parts/header.php"
?>
<?php if (isLoggedIn()): ?>
  <div
    class="card rounded shadow-sm"
    style="max-width: 500px; margin: 60px auto;"
  >
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h3 class="card-title mb-3"><?= $_SESSION["user"]["name"]; ?>'s To-Do List</h3>
        <a href="/logout_action">Logout</a>
      </div>
      <ul class="list-group">
        <!-- loop start -->
        <?php foreach($todos as $todo): ?>
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <!-- completion checkbox -->
            <form method="POST" action="/complete_todo" class="mb-0">
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
            <!-- delete button -->
            <form method="POST" action="/delete_todo" class="mb-0">
              <input 
                type="hidden"
                name="todo_id"
                value="<?= $todo["id"]; ?>" />
              <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </li>
        <?php endforeach; ?>
        <!-- loop end -->
      </ul>
      <div class="mt-4">
        <!-- add button -->
        <?php require "parts/message_error.php" ?>
        <form method="POST" action="/add_todo" class="d-flex justify-content-between">
          <input
            type="text"
            class="form-control"
            placeholder="Add new item..."
            name="todo_label"
          />
          <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
        </form>
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="d-flex justify-content-center">
    <a href="/login" class="btn btn-link" id="login">Login</a>
    <a href="/signup" class="btn btn-link" id="signup">Sign Up</a>
  </div>
<?php endif; ?>

<?php require "parts/footer.php" ?>