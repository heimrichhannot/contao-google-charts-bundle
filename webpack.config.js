var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('src/Resources/public/js/')
    .addEntry('contao-google-charts-bundle', './src/Resources/assets/js/contao-google-charts-bundle.js')
    .setPublicPath('/public/js/')
    .disableSingleRuntimeChunk()
    .configureBabel(function (babelConfig) {
    }, {
        // include to babel processing
        includeNodeModules: ['@hundh/contao-google-charts-bundle']
    })
    .enableSourceMaps(!Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
