'use strict';

var gulp = require('gulp');

var ftp = require('vinyl-ftp');
var gutil = require('gulp-util');
var minimist = require('minimist');
var args = minimist(process.argv.slice(2));

gulp.task('deploy', function() {
  var remotePath = '/restftp/';
  var conn = ftp.create({
    host: 'ftp.rammler.ch',
    user: args.user,
    password: args.password,
    parallel: 1,
    log: gutil.log
  });

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
