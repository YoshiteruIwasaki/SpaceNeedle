const path = require('path');

module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
  },
  parserOptions: {
    parser: 'babel-eslint',
    ecmaVersion: 2017,
    sourceType: 'module',
  },
  extends: [
    'airbnb-base',
    // 'eslint:recommended',
    // https://github.com/vuejs/eslint-plugin-vue#priority-a-essential-error-prevention
    // consider switching to `plugin:vue/strongly-recommended` or `plugin:vue/recommended` for stricter rules.
    // 'plugin:vue/essential'
    'plugin:vue/recommended',
    // 'plugin:prettier/recommended'
  ],
  // required to lint *.vue files
  plugins: [
    'vue',
  ],
  // add your custom rules here
  rules: {
  //  "import/extensions": "off",
    'import/no-unresolved': 'off',
  //  'import/no-extraneous-dependencies': 'off'
  },
  settings: {
    'import/core-modules': [
      'vue',
    ],
  },
};
