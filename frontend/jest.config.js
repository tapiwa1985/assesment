module.exports = {
  preset: '@vue/cli-plugin-unit-jest',
  transform: {
    '^.+\\.[t|j]sx?$': 'babel-jest',
    '^.+\\.vue$': '@vue/vue3-jest',
  },
  moduleNameMapper: {
    axios: 'axios/dist/node/axios.cjs',
},
}

