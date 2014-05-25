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

<? if(isset($notices)): ?>
  <div class="notices">
    <ul> 
      <? foreach($notices as $notice): ?>
        <li>
          <?= $notice; ?>
        </li>
      <? endforeach; ?>
    </ul>
  </div>
<? endif; ?>
