<? foreach($posts as $post): ?>
  <p>
    <b><?= $post['email']; ?></b><br>
    <?= $post['message']; ?>
  </p>
<? endforeach; ?>