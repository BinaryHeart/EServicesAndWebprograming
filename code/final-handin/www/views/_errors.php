<? if(isset($errors)): ?>
  <div class="errors">
    <ul> 
      <? foreach($errors as $error): ?>
        <li>
          <?= $error; ?>
        </li>
      <? endforeach; ?>
    </ul>
  </div>
<? endif; ?>
