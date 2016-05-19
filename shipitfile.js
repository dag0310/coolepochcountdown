module.exports = function (shipit) {
	require('shipit-deploy')(shipit);
	chalk = require('chalk');

	shipit.initConfig({
		default: {
			workspace: '/tmp/shipit-coolepochcountdown',
			deployTo: '/srv/users/serverpilot/apps/coolepochcountdown',
			repositoryUrl: 'git@bitbucket.org:chrisroweltd/coolepochcountdown.git',
			branch: 'master',
			ignores: ['.git', 'node_modules'],
			keepReleases: 2,
			deleteOnRollback: false,
			shallowClone: false,
		},
		staging: {
			servers: 'serverpilot@rex',
		}
	});

	shipit.task('uptime', function () {
		return shipit.remote('uptime');
	});


	shipit.task('symlink:public', function() {
		return shipit.remote('cd ' + shipit.config.deployTo + ' && ln -nfs current/public public')
			.then(function () {
				shipit.log(chalk.green('Current /public symlinked to root /public.'));
			});
	});

	shipit.on('published', function() {
		return shipit.remote('cd ' + shipit.config.deployTo + ' && ln -nfs current/public public')
			.then(function () {
				shipit.log(chalk.green('Current /public symlinked to root /public.'));
			});
	});
};