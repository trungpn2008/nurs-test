window.axios = require('axios');

window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


 window.axios = window.axios.create({
    baseURL: "https://care21.gxo.co.jp",
    auth: {
        username: 'care21@greentechsolutions',
        password: 'care21greentech@'
      },
      headers:{
        'X-Requested-With':'XMLHttpRequest',
        'Access-Control-Allow-Origin' : '*',
        'Access-Control-Allow-Methods': '*',
      }
})


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
