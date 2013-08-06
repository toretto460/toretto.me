require 'sinatra'

set :static, true
set :public_folder, File.dirname(__FILE__) + '/public'
set :static_cache_control, [:public, :max_age => 3600]
disable :protection

get '/' do
  File.read(File.join('public', 'index.html'))
end
