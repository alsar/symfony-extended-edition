set :application,   "Project"
set :domain,        "domain.com"
set :user,          "projectuser"

set :repository,    "git@github.com:alsar/myproject.git"
set :scm,           :git

set :stages,        %w(production staging)
set :default_stage, "staging"
set :stage_dir,     "deploy"
require 'capistrano/ext/multistage'

role :web,        domain
role :app,        domain, :primary => true
role :db,         domain, :primary => true

set :use_sudo,      false
set :keep_releases,  3

set :deploy_via, :remote_cache
set :use_composer,      true

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   ["var/log", "var/session", "web/upload", "vendor", "node_modules", "web/media/cache"]
set :writable_dirs,     ["var", "var/log", "var/session", "web/upload", "web/media/cache"]

set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

set :assets_install, true
set :dump_assetic_assets, true

ssh_options[:port] = 22
ssh_options[:forward_agent] = true


after "deploy:finalize_update" do
  run "cd #{current_release} && npm install"
  run "cd #{current_release}/frontend/app && gulp"
end
