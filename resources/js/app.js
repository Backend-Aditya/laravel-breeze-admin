import './bootstrap';

import Alpine from 'alpinejs';

import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

NProgress.configure({ showSpinner: false });

window.addEventListener('load', () => {
    NProgress.done();
});

document.addEventListener('DOMContentLoaded', () => {
    NProgress.start();
});

window.addEventListener('beforeunload', () => {
    NProgress.start();
});

window.addEventListener('load', () => {
    NProgress.done();
});

window.Alpine = Alpine;

Alpine.start();
