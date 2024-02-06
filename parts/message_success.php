<!-- show success box if $_SESSION["success"] has value -->
<?php if (isset($_SESSION["success"])): ?>
  <div class="alert alert-success" role="alert">
  <?= $_SESSION["success"]; ?>
  <!-- clear $_SESSION["success"] once shown; prevents box from persisting on page revisit -->
  <?php unset($_SESSION["success"]); ?>
  </div>
<?php endif; ?>