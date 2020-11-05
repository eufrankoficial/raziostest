const mix = require('laravel-mix');


const basePath = 'public/assets/';
const assets = __dirname + '/resources/assets/';

mix.styles([
		assets + 'css/sweetalert.min.css',
		assets + 'css/fonts.css',
		assets + 'css/styles.css'
    ],
    basePath + 'css/default.min.css'
);

mix.scripts([
		assets + 'js/vue.min.js',
    ],
    basePath + 'js/vue.min.js'
);


mix.scripts([
		assets + 'js/scripts/highlight.js',
    ],
    basePath + 'js/app.min.js'
);
