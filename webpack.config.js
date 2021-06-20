var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');


// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // dossier où seront stockés les assets compilés 
    .setOutputPath('public/build/')
    // chemin public utilisé par le serveur pour accéder au chemin de sortie
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    // .enableSingleRuntimeChunk()
    .disableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    //Sass/SCSS
    .enableSassLoader()

    .addPlugin(new CopyWebpackPlugin(
        {
            patterns: [
                { from: './assets/images', to: 'images' },
            ]
        }))

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

    .copyFiles([
        {from: './node_modules/ckeditor/', to: 'ckeditor/[path][name].[ext]', pattern: /\.(js|css)$/, includeSubdirectories: false},
        {from: './node_modules/ckeditor/adapters', to: 'ckeditor/adapters/[path][name].[ext]'},
        {from: './node_modules/ckeditor/lang', to: 'ckeditor/lang/[path][name].[ext]'},
        {from: './node_modules/ckeditor/plugins', to: 'ckeditor/plugins/[path][name].[ext]'},
        {from: './node_modules/ckeditor/skins', to: 'ckeditor/skins/[path][name].[ext]'}
    ])
    // Uncomment the following line if you are using Webpack Encore <= 0.24
    // .addLoader({test: /\.json$/i, include: [require('path').resolve(__dirname, 'node_modules/ckeditor')], loader: 'raw-loader', type: 'javascript/auto'})
;

module.exports = Encore.getWebpackConfig();
