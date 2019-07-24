# Wordpress Starter Theme
A starter theme for kicking off WP projects. It's based upon the [Timber framework](https://www.upstatement.com/timber/) for speeding up the development process.

## Install
Navigate to the theme folder "wp-content/themes/wordpress-start-theme" (rename this folder when starting a project). This will install composer, a package manager for PHP. This needs to be installed for Timber to work.
```install
npm install or npm i
```
Wait for npm to finish installing, then:
```composer
composer install
```

## Development
Run the dev command
```npm run dev
npm run dev
```
The development evironment uses Webpack to handle CSS, JS, SVG,... . [Browsersync](https://github.com/Browsersync/browser-sync) is used to reload the page after a change has been made to CSS, JS, PHP & Twig files.

## Production
Make sure there is a .babelrc file in the root, this has options that will compile ES6 -> ES5.
```npm run build
npm run build
```

## Documentation
[Timber](https://timber.github.io/docs/)
