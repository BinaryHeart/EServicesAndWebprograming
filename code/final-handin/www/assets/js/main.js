$(function(){
  listenToForm();
});

function listenToForm(){
  $('form').submit(function(){
    var message = $('form textarea').val();

    if(message){
      $('form textarea').val('');
      sendPost(message);
    }else{
      alert("Please enter a message!");
    }
    return false;
  });
}

function sendPost(message){
  var data = {
    'message': message
  };
  $.post('posts-create.php', data, function(data, status){
    $('#posts').append(data);
  });
}
