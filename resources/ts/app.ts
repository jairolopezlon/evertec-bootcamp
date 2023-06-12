// import './bootstrap'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
const app = createApp({})
const pinia = createPinia()
const files = import.meta.glob('./components/**/*.vue', { eager: true });

Object.entries(files).forEach(([path, definition]) => {
  const def: any = definition
  const componentName = path?.split('/')?.pop()?.replace(/\.\w+$/, '');
  if (!componentName) {
    return
  }
  app.component(componentName, def.default);
});

app.use(pinia)
app.mount('#app')
