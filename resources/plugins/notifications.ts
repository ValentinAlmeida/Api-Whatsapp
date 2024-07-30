import { App } from 'vue';
import Notifications from '../components/Notifications.vue';

export default {
  install(app: App) {
    app.component('Notifications', Notifications);
  },
};
