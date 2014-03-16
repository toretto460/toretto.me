var source   = $("#posts-template").html();
var posts_template = Handlebars.compile(source);

$.get('/posts', function(data){
  $('#posts').fadeOut(600, function(){
    $('#posts').html(posts_template({'posts': data}));
    $('#posts').fadeIn(400);
  });
});

$(document).foundation();
$(document).ready(function(){

  var focused;
  var reset = function(){
    if(typeof focused != 'undefined'){
      var rotatedCard = focused.children('.card')
      rotatedCard.hide();
      focused.removeClass('focused');
    }
  };

  $('.card-container').on('click', function(e){
    var clickedBox = $(this);
    if(clickedBox.hasClass('focused')){
      e.preventDefault();
      return false;
    }
    reset();
    focused = clickedBox;
    clickedBox.children('.card').fadeIn();
    clickedBox.addClass('focused');
    focused.children('.card').children().each(function(id, child){
      $(child).fadeIn(700);
    });
  });
});