
require('./bootstrap');

window.Vue = require('vue').default;



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//resources/js/app.js
const VueUploadComponent = require('vue-upload-component');
Vue.component('file-upload', VueUploadComponent);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
import Fragment from 'vue-fragment'
Vue.use(Fragment.Plugin);
import VueImg from 'v-img';
Vue.use(VueImg);
import VModal from 'vue-js-modal';
Vue.use(VModal);

import jQuery from 'jquery';
window.$ = jQuery;
require('./notification');
require('./right_and_left_block');

import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading,  {
    props: {
        spinner: 'default',
    },
    system: {
        throttleLimit: 50,
    }
    });


const app = new Vue({
    el: '#app',
});
