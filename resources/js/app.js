import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

window.Alpine = Alpine;
window.$ = window.jQuery = $;

const el = document.querySelector('#myId');

if (el) {
    const value = el.getAttribute('data-value');
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content')
    }
});

Alpine.start();
const channel = Echo.private(`App.Models.Admin.${adminID}`);

channel.notification((data) => {
    Toastify({
        text: data.body,
        duration: 4000,
        gravity: "top",     // top or bottom
        position: "right",  // left, center, right
        close: true,
        stopOnFocus: true,
    }).showToast();
});





