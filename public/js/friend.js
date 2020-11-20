$('#sent').hover(function() {
    $( this ).html('<i class="fas fa-times mr-1"></i>Cancel');
  }, function() {
    $( this ).html('<i class="fas fa-paper-plane mr-1"></i>Sent');
  })

$('#friend').hover(function() {
    $( this ).html('<i class="fas fa-minus-circle mr-1"></i>Remove');
  }, function() {
    $( this ).html('<i class="fas fa-check-circle mr-1"></i>Friend');
  })