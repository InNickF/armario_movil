importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
  'messagingSenderId': '914702139852' //TODO: Take from ENV
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();


messaging.setBackgroundMessageHandler(function (payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'BG: ' + payload.notification.title; //TODO: DEBUG and remove flag
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.icon
  };

  return self.registration.showNotification(notificationTitle,
    notificationOptions);
});
