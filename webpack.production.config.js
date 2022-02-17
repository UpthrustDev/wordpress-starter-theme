const webpack = require('path')
const path = require('path')
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')
const ProgressBarPlugin = require('progress-bar-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

module.exports = {
  mode: 'production',
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
              ident: 'postcss',
            },
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
      exclude: /node_modules\/(?!(dom7|swiper)\/).*/,
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
    },
		minimizer: [
			new UglifyJSPlugin({
	      sourceMap: true
	    }),
      new CssMinimizerPlugin(),
		]
  },
	plugins: [
    new ProgressBarPlugin(),
    new MiniCssExtractPlugin({
      filename: 'app.bundle.css',
      chunkFilename: 'vendor.[id].bundle.css'
    }),
  ],
  resolve: {
    modules: [
      path.resolve('node_modules'),
      path.resolve(__dirname, 'src'),
      path.resolve(__dirname, 'src/css')
    ]
  }
}
