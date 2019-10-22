var gulp = require('gulp')
var exec = require('child_process').exec


gulp.task('compile-gbphp', function(cb) {
    exec('php gbphp-compiler.php', function (err, stdout, stderr) {
        console.log(stdout)
        console.log(stderr)
    })
    cb()
})

gulp.task('watch', function(cb) {
    gulp.watch('**/**/*.gbphp', gulp.series('compile-gbphp'))
    cb()
})