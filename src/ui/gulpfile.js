var gulp = require('gulp');
var clean = require('gulp-clean');
var rename = require('gulp-rename');
var handlebars = require('gulp-compile-handlebars');
var createFile = require('create-file');
var gulpFn = require('gulp-fn');
var watch = require('gulp-watch');

var srcDir = 'src';
var destDir = 'output';

var thirdPartiesDir = '3rd';
var srcThirdPartiesDir = srcDir + '/' + thirdPartiesDir;
var destThirdPartiesDir = destDir + '/' + thirdPartiesDir;

var contentDir = 'content';
var srcContentDir = srcDir + '/' + contentDir;
var destContentDir = destDir + '/' + contentDir;

var viewDir = 'view';
var srcViewDir = srcDir + '/' + viewDir;
var destViewDir = destDir + '/' + viewDir;

var indexFileContent = "";
var destIndexFile = destDir + '/index.html';

handlebars.Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {

    switch (operator) {
        case 'exists':
            return (v1 != undefined) ? options.fn(this) : options.inverse(this);
        case 'not exists':
            return (v1 == undefined) ? options.fn(this) : options.inverse(this);
        case '!=':
            return (v1 != v2) ? options.fn(this) : options.inverse(this);
        case '==':
            return (v1 == v2) ? options.fn(this) : options.inverse(this);
        case '===':
            return (v1 === v2) ? options.fn(this) : options.inverse(this);
        case '<':
            return (v1 < v2) ? options.fn(this) : options.inverse(this);
        case '<=':
            return (v1 <= v2) ? options.fn(this) : options.inverse(this);
        case '>':
            return (v1 > v2) ? options.fn(this) : options.inverse(this);
        case '>=':
            return (v1 >= v2) ? options.fn(this) : options.inverse(this);
        case '&&':
            return (v1 && v2) ? options.fn(this) : options.inverse(this);
        case '||':
            return (v1 || v2) ? options.fn(this) : options.inverse(this);
        default:
            return options.inverse(this);
    }
});

gulp.task('default', ['clean', 'thirdParties', 'content', 'css', 'js', 'views', 'templates'], function () {
    createFile(destIndexFile, '<html>\n<body>\n' + indexFileContent + '</body>\n</html>\n', function (err) {
    });
});

gulp.task('clean', function () {
    return gulp.src(destDir + '/*', {read: false})
        .pipe(clean());
});

gulp.task('thirdParties', ['clean'], function () {
    return gulp.src([srcThirdPartiesDir + '/**/*'])
        .pipe(gulp.dest(destThirdPartiesDir));
});

gulp.task('content', ['clean'], function () {
    return gulp.src([srcContentDir + '/**/*'])
        .pipe(gulp.dest(destContentDir));
});

gulp.task('css', ['clean'], function () {
    return gulp.src([srcViewDir + '/**/*.css'])
        .pipe(gulp.dest(destViewDir));
});

gulp.task('js', ['clean'], function () {
    return gulp.src([srcViewDir + '/**/*.js',srcViewDir + '/**/*.map' ])
        .pipe(gulp.dest(destViewDir));
});

gulp.task('views', ['clean'], function () {
    return gulp.src([srcViewDir + '/**/*.hbs'])
        .pipe(rename(function (path) {
            path.extname = ".tpl";
        }))
        .pipe(gulp.dest(destViewDir));
});

gulp.task('templates', ['clean'], function () {

    var data = {};

    var options = {
        batch: [srcViewDir]
    }

    return gulp.src(srcViewDir + '/*.html')
        .pipe(gulpFn(function (file) {
            indexFileContent = indexFileContent + "<a href='" + viewDir + "/" + file.path.substr(file.base.length) + "'>" + file.path.substr(file.base.length) + "</a><br>\n";
        }))
        .pipe(handlebars(data, options))
        .pipe(gulp.dest(destViewDir));
});

gulp.task('watch', function () {
    watch(srcViewDir + '/**/*.hbs', function () {
        gulp.start('default');
    });
    watch(srcViewDir + '/*.html', function () {
        gulp.start('default');
    });
    watch(srcViewDir + '/**/*.css', function () {
        gulp.start('default');
    });
    watch(srcViewDir + '/**/*.js', function () {
        gulp.start('default');
    });
});