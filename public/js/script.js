var source   = $("#posts-template").html();
var posts_template = Handlebars.compile(source);

// $.get('/tumblr_posts.json', function(data){
// 	$('#posts').fadeOut(600, function(){
// 		$('#posts').html(posts_template({'posts': data}));
// 		$('#posts').fadeIn(400);
// 	});
// });