require 'sinatra'
require 'sinatra/config_file'
require 'tumblr_client'

set :static, true
set :public_folder, File.dirname(__FILE__) + '/public'
set :static_cache_control, [:public, :max_age => 3600]
disable :protection

config_file 'config/prod.yml'

Tumblr.configure do |config|
  p settings.tumblr
  config.consumer_key = settings.tumblr["consumer_key"]
  config.consumer_secret = settings.tumblr["consumer_secret"]
end

get '/posts' do
	client = Tumblr::Client.new
	posts = client.posts("toretto460.tumblr.com", :limit => 10)['posts']
	content_type 'appication/json', :charset => 'utf-8'
	posts.to_json
end

get '/' do
  content_type 'text/html', :charset => 'utf-8'
  File.read(File.join('public', 'index.html'))
end
