'use strict';

/* Configuration */

// Load dependencies
import del from 'del';
import babel from 'babelify';
import babelPolyfill from 'babel-polyfill';
import gulp from 'gulp';
import sass from 'gulp-sass';
import gutil from 'gulp-util';
import plugins from 'gulp-load-plugins';
import path from 'path';
import source from 'vinyl-source-stream';
import browserSync from 'browser-sync';
import browserify from 'browserify';

// BrowserSync
browserSync.create();

// Handle errors
function onError(err)
{
    gutil.beep();
    console.log(err.toString());

    $.notify('We could not continue');

    this.emit('end');
}

// project name = ****.dev
// Constats
const PROJECT_NAME = 'skstyleguide';
const $ = plugins({camelize: true});
const PATHS = {
    src: `../${PROJECT_NAME}-src`,
    dist: path.join(__dirname, 'dist')
};

gulp.task('test', () =>
{
    console.log(`${PATHS.src}/js/app.js`);
});

const reload = browserSync.reload;

// delete build
gulp.task('clean', cb => del(['dist', 'sourcemaps'], {dot: true}, cb)
);

gulp.task('sass', () =>
    gulp.src([`${PATHS.src}/scss/style.scss`])
        .pipe($.sourcemaps.init())
        .pipe($.sass({
            outputStyle: 'compressed',
            errLogToConsole: true
        }))
        .on('error', onError)
        .pipe($.autoprefixer(['ie >= 10']))
        .pipe($.csscomb())
        .pipe($.concat('main.css'))
        // .pipe(gulp.dest(`${PATHS.dist}/css`))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.cleanCss())
        .pipe($.sourcemaps.write('../../sourcemaps'))
        .pipe(gulp.dest(`${PATHS.dist}/css`))
        .pipe(reload({stream: true}))
        .pipe($.notify('css task finished'))
);

gulp.task('lint', () =>
{
    return gulp.src(`${PATHS.src}/js/app.js`)
        .pipe($.jshint())
        .pipe($.jshint.reporter(require('jshint-stylish')))
        .pipe($.notify('jslint task finished'))
});

gulp.task('js', ['lint'], () =>
{
    let bundler = browserify({
        entries: [
            `${PATHS.src}/js/app.js`
        ],
        debug: true,
        extensions: ['', 'js']
    });

    bundler.bundle()
        .on('error', onError)
        .pipe(source(`${PATHS.src}/js/app.js`))
        .pipe($.buffer())
        .pipe($.sourcemaps.init({loadMaps: true}))
        .pipe($.concat('app.js'))
        .pipe(gulp.dest(`${PATHS.dist}/js`))
        .pipe($.rename({
            suffix: '.min'
        }))
        .pipe($.uglify())
        .pipe(gulp.dest(`${PATHS.dist}/js`))
        .pipe($.sourcemaps.write('../../sourcemaps'))
        .pipe(reload({stream: true}))
        .pipe($.notify('js task finished'))
});

gulp.task('svg', () =>
{
    // [`${PATHS.src}/**/*.html']
    return gulp.src([`${PATHS.src}/images/icons/*.svg`])
        .pipe($.cache($.imagemin({
            progressive: true,
            svgoPlugins: [
                {removeViewBox: false},
                {cleanupIDs: false},
                {removeUnknownsAndDefaults: true},
                {removeUselessStrokeAndFill: true}
            ]
        })))
        .pipe($.svgstore({
            fileName: 'icons.svg',
            prefix: 'icon-',
            inlineSvg: true
        }))
        .pipe($.cheerio({
            parserOptions: {
                xmlMode: true
            },
            run: (_) =>
            {
                _('[fill]').removeAttr('fill');
                _('[stroke]').removeAttr('stroke');
                _('svg').attr('style', 'display: none;');
            }
        })).pipe(gulp.dest(`${PATHS.src}/images`))
        .pipe(reload({stream: true}))
        .pipe($.notify('svg task finished'))
});

gulp.task('images', () =>
    gulp.src([`${PATHS.src}/images/*`])
        .pipe($.cache($.imagemin({
            progressive: true,
            svgoPlugins: [
                {removeViewBox: false},
                {cleanupIDs: false}
            ]
        })))
        .pipe(gulp.dest(`${PATHS.dist}/images`))
        .pipe($.notify('image task finished'))
);

gulp.task('php', ()=>
{
    browserSync.reload();
});

gulp.task('serve', () =>
{
    browserSync.init({
        proxy: PROJECT_NAME + '.dev'
    });
});

gulp.task('releasefinished', () =>
{
    console.log('--- Jobs done! Checka av denna lista innan du fortsätter.');
    console.log('--- Kör gulp release innan upload.');
    console.log('--- Sätt rättigheter på uploadmappen.');
    console.log('--- Indexera viktiga kolumner i databasen.');
    console.log('--- Skapa en favicon.');
    console.log('--- Skapa en apple-touch-icon.png (144×144) (ikon som visas på hemskärmen).');
    console.log('--- Kör sajten genom FF-tillägget YSlow och gå igenom de stegen.');
    console.log('--- Se till så att sidan ser ok ut i (IE9,) IE10, IE11, Firefox, Safari och Chrome. Kolla också så att sidan fungerar i upplösningen den är byggd för.');
    console.log('--- Validera alla delar av hemsidan med validator.w3.org.');
    console.log('--- Se över möjligheter att förbättra hemsidans prestanda med PageSpeed Insights (Google)');
    console.log('--- Ta bort eventuella testkonton och stäng av felrapporteringen.');
    console.log('--- Lägg in google analytics.');
    console.log('--- Gå igenom Hardening Wordpress (http://codex.wordpress.org/Hardening_WordPress) och kör pluginet http://wordpress.org/extend/plugins/wp-security-scan/');
    console.log('--- Aktivera pluginet Wordpress SEO.');
    console.log('--- Stäm av med Produktionsledare/Projektledare så att Google Webmaster Tools finns.');
    console.log('--- Ta backup på ev. befintlig sajt samt databas.');
    console.log('--- Uppgradera till den senaste versionen av Wordpress om nya versioner kommit under utveckling.');
    console.log('--- Peka domän(erna). Glöm inte eventuella subdomäner.');
    console.log('--- Lägg till webbplatsen i Dropbox/Internt/Projekt/Statistik Wordpress-lösningar.');
    console.log('--- Wordpress - Ta bort readme.html. Filen innehåller Wordpress-version.');
});

// Gulp watch
gulp.task('watch', () =>
{
    gulp.watch(`${PATHS.src}/js/**/*.js`, ['js']);
    gulp.watch(`${PATHS.src}/scss/**/*.scss`, ['sass']);
    gulp.watch(`**.php`, ['php']);
    gulp.watch(`${PATHS.src}/images/**/*`, ['images']);
    gulp.watch(`${PATHS.src}/images/icons/**/*`, ['svg']);
});

// Default task
gulp.task('default', ['watch', 'serve']);

// Release task
gulp.task('release', ['releasefinished']);