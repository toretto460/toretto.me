require 'sinatra'
require 'sinatra/config_file'
require 'tumblr_client'

set :static, true
set :public_folder, File.dirname(__FILE__) + '/public'
set :static_cache_control, [:public, :max_age => 3600]
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
