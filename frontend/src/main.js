import "./assets/main.css";

import { createApp } from "vue";
import { createPinia } from "pinia";
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-icons/font/bootstrap-icons.css";
// import { createToast } from 'vue-toastification/dist/vue-toastification'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
// import { VueSelect } from "vue-select";
// import "vue-select/dist/vue-select.css";

import App from "./App.vue";
import router from "./router";
import NavBar from "./components/NavBar.vue";
import Footer from "./components/Footer.vue";

const app = createApp(App);
// const toast = createToast({
//     position: 'top-right',
//     timeout: 3000
// })

const options = {
  // You can set your default options here
};

app.use(createPinia());
app.use(router);
app.component("v-select", vSelect);
// app.use(toast)
app.component("nav-bar", NavBar);
app.component("footer-component", Footer);

app.use(Toast, options);
app.mount("#app");
