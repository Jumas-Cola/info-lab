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

import markdownit from 'markdown-it';
import { default as tm } from 'markdown-it-texmath';
import katex from 'katex';

window.markdownit = markdownit;
window.tm = tm;
window.katex = katex;

import hljs from 'highlight.js/lib/core';
import python from 'highlight.js/lib/languages/python';

hljs.registerLanguage('python', python);

window.hljs = hljs;
