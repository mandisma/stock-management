const path = require('path')
const ESLintPlugin = require('eslint-webpack-plugin')
const StyleLintPlugin = require('stylelint-webpack-plugin')

module.exports = {
  resolve: {
    alias: {
      '@': path.resolve('resources/js')
    }
  },
  plugins: [
    new ESLintPlugin({
      files: './resources/js/**/*.{js,vue}'
    }),
    new StyleLintPlugin({
      files: './resources/css/**/*.css',
      configFile: './.stylelintrc.json'
    })
  ]
}
