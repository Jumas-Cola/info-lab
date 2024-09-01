import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import TestCheckApi from './api/test-check';

window.TestCheckApi = TestCheckApi;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Toastify from 'toastify';

Toastify.setOption('position', 'top-right');
window.Toastify = Toastify;
