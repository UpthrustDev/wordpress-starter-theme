module.exports = {
  plugins: {
    'postcss-strip-inline-comments': {},
    'postcss-import': {},
    'postcss-preset-env': {
      stage: 0,
      browsers: 'last 1 versions',
      features: {
        'custom-properties': {
          strict: false,
          preserve: false
        }
      }
    }
  },
};
