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
Vue.component("notifications",require("./components/Notifications.vue").default)
Vue.component("cart-detail",require("./components/CartDetail.vue").default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the pages. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 var userId = document.head.querySelector('meta[name="user-id"]').content;
 var channel = Echo.channel('my-channel');
    channel.listen('.my-event', function(data) {

        var _token = '{{ csrf_token() }}';
        new_notification = data.message;
        axios.post('https://localhost/freelances/single-vendor-ecommerce/public/admin/new_notify', {
            new_notification:new_notification
        })
            .then(function (response) {
                console.log(response);
                $('#notifications_li').html(' ');
                $('#notifications_li').html(response.data.html);
                var lost_count = $('#notis_lost_count').attr('attr_notis_lost_count');
                $('#totaln_count').html(response.data.total_count);
            })
            .catch(function (error) {
                console.log(error);
            });
    });

const app = new Vue({
    el: "#app",
});
