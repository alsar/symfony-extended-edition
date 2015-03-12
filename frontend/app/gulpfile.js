var gulp 			= require('gulp'),
    less  			= require('gulp-less')
    path  			= require('path')
    livereload 		= require('gulp-livereload')
    flatten     	= require('gulp-flatten')
    concat      	= require('gulp-concat')
    postcss     	= require('gulp-postcss')
    //sourcemaps   	= require('gulp-sourcemaps')
    autoprefixer 	= require('autoprefixer-core')
    gutil 			= require('gulp-util')
    config      	= require('./gulpconfig.json');

var supportedBrowsers = ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1'];


gulp.task('default', function() {
    gulp.start('less', 'copy');
});


gulp.task('copy', function(){
  gulp.src(config.vendor_files.js)
      .pipe(flatten())
      .pipe(gulp.dest(config.build_dir + '/js'));

  gulp.src(config.vendor_files.fonts)
      .pipe(gulp.dest(config.build_dir + '/fonts'));

  gulp.src(config.vendor_files.css)
      .pipe(flatten())
      .pipe(concat('vendor.css'))
      .pipe(gulp.dest(config.build_dir + '/css'));
  
  gulp.src(config.vendor_files.images)
      .pipe(gulp.dest(config.build_dir + '/images'));

  gulp.src(config.vendor_libraries)
      .pipe(gulp.dest(config.build_dir + '/vendor'));
});

gulp.task('less', function () {

	gulp.src(config.vendor_files.less)
		.pipe(less())
        .pipe(postcss([ autoprefixer({ browsers: supportedBrowsers }) ])) //??
		.pipe(gulp.dest(config.build_dir + '/css'))
	    .pipe(livereload({ auto: false }))
	    .on('error', gutil.log);
});

gulp.task('watch', function() {
	livereload.listen();
	gulp.watch('less/*.less', ['less']);
	gulp.watch('js/*.js', ['copy']);
});

gulp.task('autoprefixer', function () {

    return gulp.src(config.build_dir + '/css/*.css')
//        .pipe(sourcemaps.init())
        .pipe(postcss([ autoprefixer({ browsers: supportedBrowsers }) ]))
//        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.build_dir +'/css'));
});