import './bootstrap';
import 'flowbite';

import './custom/dark-mode.js';
import './custom/darkModeSystem.js';
import './custom/sidebar.js';
import './custom/custom.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import.meta.glob([
    '../images/**',
]);
