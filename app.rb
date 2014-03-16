require 'sinatra'
require 'sinatra/config_file'
require 'tumblr_client'
require 'sinatra/assetpack'

register Sinatra::AssetPack

assets {
  serve '/js',     from: 'public/js'
  serve '/js',     from: 'bower_components/jquery/dist'
  serve '/js',     from: 'bower_components/jquery.transit'
  serve '/js',     from: 'bower_components/foundation/js'
  serve '/fonts',  from: 'public/fonts'

  serve '/css/',   from: 'public/css'       # Default
  serve '/images', from: 'public/images'    # Default

  # The second parameter defines where the compressed version will be served.
  # (Note: that parameter is optional, AssetPack will figure it out.)
  js :app, '/js/app.js', [
    '/public/js/script.js',
    '/js/jquery.min.js',
    '/js/jquery.transit.js',
    '/js/foundation.min.js'
  ]

  #css :application, '/css/application.css', [
  #  '/css/screen.css'
  #]

  #js_compression  :jsmin    # :jsmin | :yui | :closure | :uglify
  #css_compression :simple   # :simple | :sass | :yui | :sqwish
}

#set :static, true
#set :public_folder, File.dirname(__FILE__) + '/public'
#set :static_cache_control, [:public, :max_age => 3600]
disable :protection

Tumblr.configure do |config|
  config_file 'config/prod.yml'
  config.consumer_key = settings.tumblr["consumer_key"]
  config.consumer_secret = settings.tumblr["consumer_secret"]
end

get '/posts' do
	headers 'X-Who-i-am' => 'If you are reading this header maybe you are interested on http://goo.gl/HFGqUh'
	client = Tumblr::Client.new
	posts = client.posts("toretto460.tumblr.com", :limit => 10)['posts']
	content_type 'text/json', :charset => 'utf-8'
	posts.to_json
end

get '/' do
  headers 'X-Who-i-am' => 'If you are reading this header maybe you are interested on http://goo.gl/HFGqUh'
  content_type 'text/html', :charset => 'utf-8'
  File.read(File.join('public', 'index.html'))
end
