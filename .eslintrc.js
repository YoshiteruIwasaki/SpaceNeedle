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
    'prettier',
  ],
  // add your custom rules here
  rules: {
    'no-unused-vars': [0],
    'no-console': [0],
    'no-param-reassign': [0],
    //  "import/extensions": "off",
    'import/no-unresolved': 'off',
    'import/no-extraneous-dependencies': 'off',
    // タグの最後で改行しないで
    'vue/html-closing-bracket-newline': [2, { multiline: 'never' }],
    'vue/max-attributes-per-line': [0],
    'vue/require-v-for-key': [0],
  },
  settings: {
    'import/core-modules': [
      'vue',
    ],
  },
};
