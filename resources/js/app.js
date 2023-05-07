import './bootstrap.js';
import '../css/app.css';

import {createApp} from 'vue/dist/vue.esm-bundler'
import Notification from './components/Notification.vue';

const app = createApp({
    components: {
        Notification
    },
});

app.mount("#app");