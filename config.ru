require 'rubygems' 
require 'bundler/setup'
require './app'

ENV['GEM_HOME'] = '/home/toretto/www/toretto.me/shared/bundle/ruby/2.0.0'

run Sinatra::Application