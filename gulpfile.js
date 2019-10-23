var gulp = require('gulp')
var exec = require('child_process').exec


gulp.task('compile-gbphp', function(cb) {
    exec('php gbphp-compiler.php', function (err, stdout, stderr) {
        if (stdout) {
            console.log(stdout)
        }
        if (stderr) {
            console.log(stderr)
        }
    })
    cb()
})

gulp.task('watch', function(cb) {
    gulp.watch('**/**/*.gbphp', gulp.series('compile-gbphp'))
    cb()
})