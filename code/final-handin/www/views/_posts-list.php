<? foreach($posts as $post): ?>
  <p>
    <b><?= $post['title']; ?></b>:
    <?= $post['message']; ?>
  </p>
<? endforeach; ?>