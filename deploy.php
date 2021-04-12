<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my-project');

// Project repository
set('repository', 'git@appsolute-git.fr:appsolute-internal/laravel-bo-api-starter.git');

// Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Do not clone submodules.
set('git_recursive', false);

// Shared files/dirs between deploys
add('shared_files', [
    'auth.json',
]);
add('shared_dirs', []);
set('http_user', 'www-data');

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('develop')
    ->set('branch', 'develop')
    ->user('appsolute')
    ->hostname('my-project.appsolute.dev')
    ->set('deploy_path', '/var/www/my-project.appsolute.dev')
    ->forwardAgent(true)
    ->multiplexing(false)
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no');

// Backup database
task('backup', function () {
    run('php {{deploy_path}}/release/artisan backup:run --only-db --disable-notifications');
});

// Restart supervisor
task('supervisor:restart', function () {
    run('sudo supervisorctl restart laravel-horizon:*');
});

// Restart php
task('php-fpm:restart', function () {
    run('sudo service php8.0-fpm restart');
});

// Upload assets
task('upload:assets', function () {
    upload('public/css/', '{{release_path}}/public/css');
    upload('public/js/', '{{release_path}}/public/js');
    upload('public/images/', '{{release_path}}/public/images');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

// Backup before migrate
before('artisan:migrate', 'backup');

// Restart php-fpm
after('cleanup', 'php-fpm:restart');

// Restart queue
after('php-fpm:restart', 'supervisor:restart');

// Upload assetes
after('deploy:vendors', 'upload:assets');
