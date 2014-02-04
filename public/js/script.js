var source   = $("#posts-template").html();
var posts_template = Handlebars.compile(source);

$.get('/posts', function(data){
	//$('#posts').html(posts_template({'posts': data}));
  });