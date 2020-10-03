const cssImport = require('postcss-import')
const cssNesting = require('postcss-nesting')
const mix = require('laravel-mix')
const path = require('path')
const purgecss = require('@fullhuman/postcss-purgecss')
const tailwindcss = require('tailwindcss')


mix.postCss('resources/css/app.css', 'public/css/app.css')
   .options({
      postCss: [
         cssImport(),
         cssNesting(),
         tailwindcss('resources/js/tailwind.config.js'),
         ...mix.inProduction() ? [
            purgecss({
               content: ['./resources/views/**/*.blade.php', './resources/js/**/*.vue'],
               defaultExtractor: content => content.match(/[\w-/:.]+(?<!:)/g) || [],
               whitelistPatternsChildren: [/nprogress/],
            }),
         ] : [],
      ],
   })
   .version()
   .sourceMaps()