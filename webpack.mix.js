const glob = require("glob");
const mix = require("laravel-mix");
const WebpackShellPluginNext = require("webpack-shell-plugin-next");

require("laravel-mix-merge-manifest");
// let configs;
// compile admin and theme assets
let configs = glob.sync(
    "{./Themes/*/webpack.mix.js}"
);

// compile theme assets
// let configs = glob.sync("./Themes/*/webpack.mix.js");

// if (process.env.module !== undefined) {
//     let module =
//         process.env.module.charAt(0).toUpperCase() +
//         process.env.module.slice(1);
//
//     configs = [`./Modules/${module}/webpack.mix.js`];
// }
console.log(222)
let theme = 'Storefront';

configs = [`./Themes/${theme}/webpack.mix.js`];

mix.setPublicPath("./")
    .options({ processCssUrls: false })
    .sourceMaps(true, "eval-source-map")
    .mergeManifest();

let commands = [];

configs.forEach(config => {
    require(config);

    // let module = config.match(/Modules\/(\w+?)\//);
    let theme = config.match(/Themes\/(\w+?)\//);
    console.log(theme);
    //
    // if (module !== null) {
    //     commands.push(`php artisan module:publish ${module[1]}`);
    // }

    if (theme !== null) {
        commands.push(`php artisan stylist:publish ${theme[1]}`);
    }
});

mix.webpackConfig({
    plugins: [
        new WebpackShellPluginNext({
            onBuildExit: {
                scripts: commands,
                blocking: false,
                parallel: true
            }
        })
    ]
});
console.log(__dirname);
mix.copy(
        `${__dirname}/Themes/Storefront/assets/public/css/app.css`,
        `${__dirname}/public/themes/storefront/public/css/app.css`
    )
