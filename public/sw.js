
const CACHE_VERSION = 1;
const CURRENT_CACHES = {
  'read-through': 'read-through-cache-v' + CACHE_VERSION
};


self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open('mysite-static-v3').then(function(cache) {
      return cache.addAll([
        'http://code.jquery.com/jquery-1.8.3.js',
        'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        'css/chosen.min.css',
        'slick/slick.css',
        'slick/theme/slick-theme.css',
        'images/African-Rhythm-7.png',
        'js/app.js',
        'js/chosen.jquery.min.js',
        'js/chosen.js',
        'slick/slick.min.js',
        'slick/slick.js',
        '/',
        // etc
      ]);
    })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.open('mysite-dynamic').then(function(cache) {
      return cache.match(event.request).then(function (response) {
        return response || fetch(event.request).then(function(response) {
          //cache.put(event.request, response.clone());
          return response;
        });
      });
    })
  );
});