set :application, "My Project"
set :domain,      "myproject.com"
set :user,        "alsar"
set :deploy_to,   "/var/www/myproject"

set :repository,  "git@github.com:alsar/myproject.git"
set :scm,         :git

role :web,        domain
role :app,        domain, :primary => true
role :db,         domain, :primary => true

set :use_sudo,      false
set :keep_releases,  3

set :deploy_via, :remote_cache

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   ["var/log", "var/session", "web/upload", "vendor"]
set :use_composer,      true

set :writable_dirs,       ["var", "web/upload"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

#logger.level = Logger::MAX_LEVEL
