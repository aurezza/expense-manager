/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import $ from "jquery";

window.Vue = require("vue");
window.$ = jQuery = $;

Vue.component("v-login", require("./components/login/Login.vue").default);

//Common components
Vue.component(
    "v-sidebar",
    require("./components/common/SideBarComponent.vue").default
);
Vue.component(
    "v-header",
    require("./components/common/HeaderComponent.vue").default
);
Vue.component("v-box", require("./components/BoxComponent.vue").default);
Vue.component(
    "v-chart",
    require("./components/common/ChartComponent.vue").default
);

const app = new Vue({
    el: "#app"
});
