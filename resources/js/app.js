require("./src/main");
  import './../scss/theme.scss'
import axios from "axios";
import VueAxios from 'vue-axios'
import Vue from 'vue'
import {createInertiaApp, Link} from '@inertiajs/inertia-vue'
import vuetify from "./src/plugins/vuetify";
import {InertiaProgress} from '@inertiajs/progress'

import DatetimePicker from 'vuetify-datetime-picker'
// (Optional) import 'vuetify-datetime-picker/src/stylus/main.styl'

Vue.use(DatetimePicker)
Vue.use(VueAxios, axios)




Vue.component('inertia-link', Link);
Vue.component('Link', Link)
Vue.component('router-link', {
  functional: true,
  render(h, context) {
    const data = {...context.data}
    delete data.nativeOn
    const props = data.props || {}
    props.href = props.to
    return h('inertia-link', data, context.children)
  },
})

createInertiaApp({
  resolve: resolvePage,
  setup: appSetup,

})

function appSetup({el, App, props, plugin}) {
  Vue.use(plugin)
  new Vue({

    vuetify,
    render: h => h(App, props),
  }).$mount(el)


}

import Layout from './src/layouts/dashboard/Content'
function resolvePage(pageName) {
  let page = import(`./src/${pageName}`);
  page.then(page => {

      page.default.layout = page.default.layout || Layout;

     // EventBus.$emit('PageLoaded', page.default);
    // currentPage = page.default;
    return page;
  });

  return page;
}


InertiaProgress.init({
  delay: 0,
  color: '#9155fd',
  showSpinner: true,
  includeCSS: true,
})
