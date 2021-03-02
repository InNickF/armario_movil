<?php
/* (c) Anton Medvedev <anton@medv.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/*
 * This recipe supports Laravel 5.1+, for older versions, please read the documentation https://github.com/deployphp/docs
 */

namespace Deployer;

require_once 'recipe/common.php';
// Laravel shared dirs
set('shared_dirs', [
	'storage',
]);
// Laravel shared file
set('shared_files', [
	'.env',
]);
// Laravel writable dirs
set('writable_dirs', [
	'bootstrap/cache',
	'storage',
	'storage/app',
	'storage/app/public',
	'storage/framework',
	'storage/framework/cache',
	'storage/framework/sessions',
	'storage/framework/views',
	'storage/logs',
]);
set('laravel_version', function () {
	$result = run('cd {{release_path}} && {{bin/php}} artisan --version');
	preg_match_all('/(\d+\.?)+/', $result, $matches);
	$version = $matches[0][0] ?? 5.5;
	return $version;
});

set('deploy_path', '/var/www/html/armario-movil');
set('release_path', '/var/www/html/armario-movil');
/**
 * Helper tasks
 */
desc('Disable maintenance mode');
task('artisan:up', function () {
	$output = run('if [ -f {{deploy_path}}/artisan ]; then {{bin/php}} {{deploy_path}}/artisan up; fi');
	writeln('<info>' . $output . '</info>');
});
desc('Enable maintenance mode');
task('artisan:down', function () {
	$output = run('if [ -f {{deploy_path}}/artisan ]; then {{bin/php}} {{deploy_path}}/artisan down; fi');
	writeln('<info>' . $output . '</info>');
});
desc('Execute artisan migrate');
task('artisan:migrate', function () {
	run('php artisan migrate --force');
})->once();
desc('Execute artisan migrate:fresh');
task('artisan:migrate:fresh', function () {
	run('php artisan migrate:fresh --force');
});
desc('Execute artisan migrate:rollback');
task('artisan:migrate:rollback', function () {
	$output = run('php artisan migrate:rollback --force');
	writeln('<info>' . $output . '</info>');
});
desc('Execute artisan migrate:status');
task('artisan:migrate:status', function () {
	$output = run('php artisan migrate:status');
	writeln('<info>' . $output . '</info>');
});
desc('Execute artisan db:seed');
task('artisan:db:seed', function () {
	$output = run('php artisan db:seed --force');
	writeln('<info>' . $output . '</info>');
});
desc('Execute artisan cache:clear');
task('artisan:cache:clear', function () {
	run('php artisan cache:clear');
});
desc('Execute artisan config:cache');
task('artisan:config:cache', function () {
	run('php artisan config:cache');
});
desc('Execute artisan route:cache');
task('artisan:route:cache', function () {
	run('php artisan route:cache');
});
desc('Execute artisan view:clear');
task('artisan:view:clear', function () {
	run('php artisan view:clear');
});
desc('Execute artisan optimize');
task('artisan:optimize', function () {
	$deprecatedVersion = 5.5;
	$readdedInVersion = 5.7;
	$currentVersion = get('laravel_version');
	if (
		version_compare($currentVersion, $deprecatedVersion, '<') ||
		version_compare($currentVersion, $readdedInVersion, '>=')
	) {
		run('php artisan optimize');
	}
});
desc('Execute artisan optimize:clear');
task('artisan:optimize:clear', function () {
	$needsVersion = 5.7;
	$currentVersion = get('laravel_version');
	if (version_compare($currentVersion, $needsVersion, '>=')) {
		run('php artisan optimize:clear');
	}
});
desc('Execute artisan queue:restart');
task('artisan:queue:restart', function () {
	run('php artisan queue:restart');
});
desc('Execute artisan horizon:terminate');
task('artisan:horizon:terminate', function () {
	run('php artisan horizon:terminate');
});
desc('Execute artisan storage:link');
task('artisan:storage:link', function () {
	$needsVersion = 5.3;
	$currentVersion = get('laravel_version');
	if (version_compare($currentVersion, $needsVersion, '>=')) {
		run('php artisan storage:link');
	}
});
/**
 * Task deploy:public_disk support the public disk.
 * To run this task automatically, please add below line to your deploy.php file
 *
 *     before('deploy:symlink', 'deploy:public_disk');
 *
 * @see https://laravel.com/docs/5.2/filesystem#configuration
 */
desc('Make symlink for public disk');
task('deploy:public_disk', function () {
	// Remove from source.
	run('if [ -d $(echo {{release_path}}/public/storage) ]; then rm -rf {{release_path}}/public/storage; fi');
	// Create shared dir if it does not exist.
	run('mkdir -p {{deploy_path}}/shared/storage/app/public');
	// Symlink shared dir to release dir
	run('{{bin/symlink}} {{deploy_path}}/shared/storage/app/public {{release_path}}/public/storage');
});
/**
 * Main task
 */
desc('Deploy your project');
task('deploy', [
	'deploy:info',
	'deploy:prepare',
	'deploy:lock',
	'deploy:release',
	'deploy:update_code',
	'deploy:shared',
	'deploy:vendors',
	'deploy:writable',
	'artisan:storage:link',
	'artisan:view:clear',
	'artisan:config:cache',
	'artisan:optimize',
	'deploy:symlink',
	'deploy:unlock',
	'cleanup',
]);



task('permissions', function () {
	run('sudo chown -R $USER:www-data ./');
	// run('sudo find ./ -type f -exec chmod 644 {} \;');
	// run('sudo find ./ -type d -exec chmod 755 {} \;');
	run('sudo chgrp -R www-data storage bootstrap/cache');
	run('sudo chmod -R ug+rwx storage bootstrap/cache');
	run('sudo usermod -a -G www-data $USER');
	run('sudo chmod +x ./vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
	run('sudo chmod +x ./vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64');
	run('sudo chown -R www-data:www-data storage');
	run('sudo chmod 777 -R ./storage/');
});


task('cache', function () {
	run('php artisan cache:clear');
	run('php artisan config:cache');
	run('composer dump-autoload');
});

task('clean', [
	'permissions',
	'cache',
]);

task('clean_storage', function () {
	run('sudo rm -rf ./storage/app/public/*');
});

task('build:dependencies', function () {
	run('composer install');
	run('npm rebuild');
	run('npm install');
});

desc('Launch in Local');
task('run', function () {
	run('npm run watch');
});

desc('Build assets');
task('build:npm', function () {
	run('npm run dev');
});

task('build:watch', function () {
	run('npm run watch');
});

desc('Build assets');
task('git:pull', function () {
	run('git reset --hard');
	run('git pull');
});

desc('Local RESET: Reset project and seed');
task('fresh', [
	// 'permissions',
	'clean_storage',
	'artisan:migrate:fresh',
	'artisan:db:seed',
	'artisan:view:clear',
	'artisan:config:cache',
	'artisan:cache:clear',
]);

desc('Local build: Build and launch');
task('watch', [
	// 'permissions',
	'artisan:view:clear',
	'artisan:config:cache',
	'artisan:cache:clear',
	'build:watch',
]);

desc('Build Stage');
task('stage', [
	'git:pull',
	'permissions',
	'build:dependencies',
	'artisan:migrate:fresh',
	'artisan:db:seed',
	'artisan:view:clear',
	'artisan:config:cache',
	'artisan:cache:clear',
	'build:npm',
]);

desc('Build Production');
task('prod', [
	'git:pull',
	'permissions',
	'build:dependencies',
	'artisan:migrate',
	'artisan:storage:link',
	'artisan:view:clear',
	'artisan:config:cache',
	'artisan:optimize',
	'artisan:cache:clear',
	'build:npm',
]);

after('deploy', 'success');