const path = require('path')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
var BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = {
  mode: 'development',
  module: {
    rules: [{
      test: /\.(sa|sc|c)ss$/,
      use: [
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            importLoaders: 3,
            modules: {
              exportOnlyLocals: false,
            }
          }
        },
        {
          loader: 'postcss-loader',
          options: {
            postcssOptions: {
              ident: 'postcss'
            }
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
            //sourceMapContents: false
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
      options: {
        presets: [
          ['@babel/preset-env']
        ]
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
    new MiniCssExtractPlugin({
      filename: 'app.bundle.css',
      chunkFilename: '[id].bundle.css'
    }),
    new BundleAnalyzerPlugin(),
		new BrowserSyncPlugin({
      files: ['**/*.php', '**/*.twig' ],
      proxy: 'http://localhost/wordpress'
    })
  ],
  devtool: 'source-map',
  resolve: {
    modules: [
      path.resolve('node_modules'),
      path.resolve(__dirname, 'src'),
      path.resolve(__dirname, 'src/css')

    ]
  }
}
