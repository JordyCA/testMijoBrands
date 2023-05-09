let mix = require('laravel-mix');

mix.js('src/js/main.js', 'dist/js')
   .js('src/js/blog-scripts.js', 'dist/js')
   .postCss('src/css/main.css', 'dist/css')
   .postCss('src/css/button.css', 'dist/css')
   .postCss('src/css/blog-styles.css', 'dist/css')
   .setPublicPath('dist');