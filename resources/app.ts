import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { vuetify } from './plugins/vuetify';
import notificationsPlugin from './plugins/notifications';

const app = createApp(App);

app.use(router).use(vuetify).use(notificationsPlugin);

app.mount('#app');
