require 'rubygems'
require 'railsless-deploy'

set :application, "coolepochcountdown.com"

set :domain,  "buzz"
set :user,    "chrisrowe"
set :deploy_to, "/home/#{user}/sites/#{application}"
set :repository, "git@bitbucket.org:chrisrowenet/#{application}.git"

set :scm, :git
set :ssh_options, { :forward_agent => true }
set :deploy_via, :remote_cache
set :copy_strategy, :checkout
set :keep_releases, 3
set :use_sudo, false
set :copy_compression, :bz2

server "#{domain}", :app, :web, :db, :primary => true

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
  ServerAdmin admin@#{application}
  ServerName  www.#{application}
  ServerAlias #{application}

  # Index file and Document Root (where the public files are located)
  DirectoryIndex index.html index.php
  DocumentRoot /home/#{user}/sites/#{application}/current

  # Log file locations
  LogLevel warn
  ErrorLog  /home/#{user}/sites/#{application}/logs/error.log
  CustomLog /home/#{user}/sites/#{application}/logs/access.log combined
</VirtualHost>
    EOF
    put vhost_config, "/tmp/vhost_config"
    sudo "mv /tmp/vhost_config /etc/apache2/sites-available/#{application}"
    run "mkdir /home/#{user}/sites/#{application}/logs"
    run "ln -s /home/#{user}/sites/holding /home/#{user}/sites/#{application}/current"
    sudo "a2ensite #{application}"
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