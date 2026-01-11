import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';

window.Alpine = Alpine;
window.$ = window.jQuery = $;


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content')
    }
});

Alpine.start();
var channel = Echo.private(`App.Models.User.${userID}`);
channel.notification(function (data) {
    console.log(data);
    alert(data.body);
});



