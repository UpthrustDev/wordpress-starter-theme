require('@babel/polyfill')
const path = require('path')
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')
const ProgressBarPlugin = require('progress-bar-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

module.exports = {
  mode: 'production',
  module: {
    rules: [{
      test: /\.(sa|sc|c)ss$/,
      use: [
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
        },
        {
          loader: 'postcss-loader',
          options: {
            ident: 'postcss'
          }
        },
        {
          loader: 'resolve-url-loader',
          options: {

          }
        },
        {
          loader: 'sass-loader',
          options: {
            sourceMap: true,
            sourceMapContents: false
          }
        }
      ]
    },
    {
      test: /\.(woff|woff2|eot|ttf|otf)$/,
      use: [{
        loader: 'file-loader',
        options: {
          name: '[name].[ext]',
          outputPath: 'fonts/'
        }
      }]
    },
    {
      test: /\.svg/,
      use: {
        loader: 'svg-url-loader',
        options: {}
      }
    },
    {
      test: /\.js$/,
      loader: 'babel-loader',
      query: {
        presets: ['@babel/preset-env', '@babel/preset-react']
      }
    }
    ]
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'app.bundle.js'
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        commons: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          filename: 'vendor.bundle.js',
          chunks: 'all'
        }
      }
    }
  },
  plugins: [
    new ProgressBarPlugin(),
    new MiniCssExtractPlugin({
      filename: 'app.bundle.css',
      chunkFilename: 'vendor.[id].bundle.css'
    }),
    new UglifyJSPlugin({
      sourceMap: true
    })
  ],
  resolve: {
    modules: [
      path.resolve('node_modules'),
      path.resolve(__dirname, 'src'),
      path.resolve(__dirname, 'src/css')
    ]
  }
}
