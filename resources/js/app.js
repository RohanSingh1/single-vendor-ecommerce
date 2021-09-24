/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

window.bus = new Vue();
Vue.component("example-component",require("./components/ExampleComponent.vue").default);
Vue.component("products",require("./components/ProductsComponent.vue").default);
Vue.component("cart-count",require("./components/CartCount.vue").default)
Vue.component("cart-detail",require("./components/CartDetail.vue").default)
Vue.component("GmapMap",require("./components/Maps.vue").default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the pages. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import * as VueGoogleMaps from 'vue2-google-maps'

 Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyBCPYKfOKFC6qluIWWrS-I_pWybwacO_sE',
      v: '3.26',
    },
    // Demonstrating how we can customize the name of the components
    installComponents: false,
  });

    Vue.component('google-map', VueGoogleMaps.Map);
    Vue.component('ground-overlay', VueGoogleMaps.MapElementFactory({
      mappedProps: {
        'opacity': {}
      },
      props: {
        'source': {type: String},
        'bounds': {type: Object},
      },
      events: ['click', 'dblclick'],
      name: 'groundOverlay',
      ctr: () => google.maps.GroundOverlay,
      ctrArgs: (options, {source, bounds}) => [source, bounds, options],
    }));



const app = new Vue({
    el: "#app",
    data:{
        itemCount:0
    },
    created(){
        console.log(this.itemCount);

        bus.$on('add-to-cart',()=>{
            this.increaseCounter();
        })
    },
    methods:{
        increaseCounter(now_quantity){
            return this.itemCount++;
        }
    }
});
