'use strict';

var gulp = require('gulp');

var ftp = require('vinyl-ftp');
var gutil = require('gulp-util');
var minimist = require('minimist');
var args = minimist(process.argv.slice(2));

gulp.task('deploy', function() {
  var remotePath = '/restftp/';

    if(args.branch == 'master') {
        var user = args.user;
        var password = args.password;
    } else {
        var user = args.user_sandbox;
        var password = args.password_sandbox;
    }

  var conn = ftp.create({
    host: 'ftp.rammler.ch',
    user: user,
    password: password,
    parallel: 1,
    log: gutil.log
  });
    gutil.log(args.user, gutil.colors.magenta('123'));

    var globs = [
        'images/**',
        'src/**',
        'vendor/**',
        '.htaccess',
        'index.php'
    ];

  gulp.src(globs, { base: '.', buffer: false })
    .pipe(conn.newer('rest'))
    .pipe(conn.dest('rest'));
});
