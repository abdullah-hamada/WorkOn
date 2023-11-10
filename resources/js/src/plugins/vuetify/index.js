import Vue from 'vue'
import Vuetify from 'vuetify/lib/framework'
import preset from './default-preset/preset'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

Vue.use(Vuetify)

export default new Vuetify({
  preset,
  icons: {
    iconfont: 'mdi',
  },
  rtl: true,

  theme: {
    light: {
      primary: 'red',
      secondary: '#b0bec5',
      accent: '#8c9eff',
      error: '#b71c1c',
    },
    options: {
      // customProperties: true,
      // variations: false,
    },
  },
})
