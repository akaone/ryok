const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
mix.setPublicPath("./")

mix.postCss('resources/css/app.css', 'public/css/app.css', [tailwindcss('resources/js/tailwind.config.js')])
mix.postCss('resources/css/mail.css', 'resources/views/vendor/mail/html/themes/default.css', [tailwindcss('resources/js/mail.config.js')])
   .version()
   .sourceMaps()
