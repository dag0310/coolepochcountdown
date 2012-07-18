require 'rubygems'
require 'railsless-deploy'

set :domain, "coolepochcountdown.com"

set :server,  "buzz"
set :user,    "chrisrowe"
set :deploy_to, "/home/#{user}/sites/#{domain}"
set :repository, "git@bitbucket.org:chrisrowenet/#{domain}.git"

set :scm, :git
set :ssh_options, { :forward_agent => true }
set :deploy_via, :remote_cache
set :copy_strategy, :checkout
set :keep_releases, 3
set :use_sudo, false
set :copy_compression, :bz2

server "#{server}", :app, :web, :db, :primary => true

namespace :deploy do
  task :default do
    transaction do
      update_code
      symlink
    end
  end

  task :update_code, :except => { :no_release => true } do
    on_rollback { run "rm -rf #{release_path}; true" }
    strategy.deploy!
  end

  task :after_deploy do
    cleanup
  end

  task :after_setup do
    vhost_config =<<-EOF
<VirtualHost *:80>
  # Admin email, Server Name (domain name), and any aliases
  ServerAdmin admin@#{domain}
  ServerName  www.#{domain}
  ServerAlias #{domain}

  # Index file and Document Root (where the public files are located)
  DirectoryIndex index.html index.php
  DocumentRoot /home/#{user}/sites/#{domain}/current

  # Log file locations
  LogLevel warn
  ErrorLog  /home/#{user}/sites/#{domain}/logs/error.log
  CustomLog /home/#{user}/sites/#{domain}/logs/access.log combined
</VirtualHost>
    EOF
    put vhost_config, "/tmp/vhost_config"
    sudo "mv /tmp/vhost_config /etc/apache2/sites-available/#{domain}"
    run "mkdir /home/#{user}/sites/#{domain}/logs"
    run "ln -s /home/#{user}/sites/holding /home/#{user}/sites/#{domain}/current"
    sudo "a2ensite #{domain}"
    run "sudo service apache2 restart"
  end

end

after "deploy:setup", "deploy:after_setup"

namespace :apache do
  [:stop, :start, :restart, :reload].each do |action|
    desc "#{action.to_s.capitalize} Apache"
    task action, :roles => :web do
      run "sudo service apache2 #{action.to_s}"
    end
  end
end