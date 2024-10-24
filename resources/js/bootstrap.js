import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import TestCheckApi from './api/test-check';

window.TestCheckApi = TestCheckApi;

import AiTeacherApi from './api/ai-teacher';

window.AiTeacherApi = AiTeacherApi;

import Cookies from 'js-cookie';

window.Cookies = Cookies;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Toastify from 'toastify';

Toastify.setOption('position', 'top-right');
window.Toastify = Toastify;

import { marked } from 'marked';

window.marked = marked;
