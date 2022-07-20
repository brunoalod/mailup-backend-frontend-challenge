import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import userStore from './store/user_store'
import './assets/scss/app.scss';

createApp(App)
    .use(userStore)
    .use(router)
    .mount('#app')
