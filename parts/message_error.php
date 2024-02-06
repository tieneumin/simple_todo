<!-- show error box if $_SESSION["error"] has value -->
<?php if (isset($_SESSION["error"])): ?>
  <div class="alert alert-danger" role="alert">
  <?= $_SESSION["error"]; ?>
  <!-- clear $_SESSION["error"] once shown; prevents box from persisting on page revisit -->
  <?php unset($_SESSION["error"]); ?>
  </div>
<?php endif; ?>