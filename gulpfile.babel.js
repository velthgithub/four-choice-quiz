'use strict';

// ==================================
//
// distribution
//
// ==================================
import gulp from 'gulp';

gulp.task('copy', function() {
	return gulp.src(
		[
			'./**/*.php',
			'./style.css',
			'./bundle.js',
			'./*.json',
			'./*.txt',
			'./*.md',
			"!./dist/**",
			"./vendor/**",
			"!./node_modules/**/*.*"
		],
		{ base: './' }
	).pipe( gulp.dest( 'dist' ) );
} );
