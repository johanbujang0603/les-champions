module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: [
    'plugin:vue/recommended',
    'airbnb-base',
  ],
  parserOptions: {
    parser: 'babel-eslint',
    ecmaVersion: 2020,
    sourceType: 'module',
    ecmaFeatures: {
      legacyDecorators: true,
    },
  },
  plugins: [
    'vue',
  ],
  rules: {
    'import/no-extraneous-dependencies': ['error', { devDependencies: true }],
    'vue/max-attributes-per-line': ['error', { singleline: 4 }],
    'max-len': [2, { code: 150, ignorePattern: 'd="([\\s\\S]*?)"' }],
    'class-methods-use-this': ['error', { exceptMethods: ['data'] }],
    'object-curly-newline': ['error', {
      ExportDeclaration: { multiline: true, minProperties: 5 },
    }],
  },
};
