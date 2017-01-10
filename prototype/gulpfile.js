var gulp = require('gulp');
var concat = require('gulp-concat');
var scss = require('gulp-sass');
var minify = require('gulp-cssnano');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var rimraf = require('gulp-rimraf');
var ignore = require('gulp-ignore');
var gulpif = require('gulp-if');
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var watch = require('gulp-watch');



var sync = require('browser-sync').create();
var reload = sync.reload;




var paths = {
  "bower": './bower_components/',
  "node": "./node_modules/",
  "src": "./",
  "sass": "./sass/"
};



var output = {
  "sass": "motors-theme.css",
  "js": "motors-theme.js"
};


var assets = {
  "js" : [
    paths.bower + "bootstrap/dist/js/bootstrap.min.js"
  ],
  "css": [
    paths.bower + "bootstrap/dist/css/*.min.css",
    paths.bower + "font-awesome/css/font-awesome.min.css"
  ], 
  "fonts": [
    paths.bower + "bootstrap/fonts/**/*",
    paths.bower + "font-awesome/fonts/**/*"
  ]
};



gulp.task("sass", function(done) {
  gulp.src(paths.sass + "**/*.scss")
    .pipe(sass({
      outputStyle: "expanded"
    }).on("error", sass.logError))
    .pipe(rename(output.sass))
    .pipe(gulp.dest(paths.src + "css/"))
    .pipe(reload({
      stream: true
    }));
  done();
});





gulp.task('serve', function() {
  sync.init({
    server: {
      baseDir: "./"
    },
    files: [
      paths.src + '**/*.html',
      paths.src + '**/*.css',
      paths.src + '**/*.js'
    ],
    open: false,
    notify: true
  });

  watch(paths.sass + "**/*.scss", function() {
      gulp.start('sass');
  });
});