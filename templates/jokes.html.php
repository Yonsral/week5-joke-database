

<?php foreach ($jokes as $joke): ?>
  <div style="display: flex; align-items: center; margin-bottom: 20px;">
      <?php if (!empty($joke['imagepath'])): ?>
          <img src="<?= htmlspecialchars($joke['imagepath']) ?>" 
               alt="Joke image" 
               width="100" height="100" 
               style="margin-right: 20px; border-radius: 10px;">
      <?php endif; ?>

      <div>
          <p style="margin: 0 0 5px 0;">
              <?= htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8') ?>
          </p>
          <small style="color: gray;">
              Posted on: <?= htmlspecialchars($joke['jokedate'], ENT_QUOTES, 'UTF-8') ?>
          </small>
          <form action="deletejoke.php" method="post" style="margin-top: 10px;">
              <input type="hidden" name="id" value="<?= $joke['id'] ?>">
              <input type="submit" value="Delete">
          </form>
      </div>
  </div>
  <hr>
<?php endforeach; ?>
