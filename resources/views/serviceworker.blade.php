var staticCacheName = "pwa-v" + new Date().getTime();

var filesToCache = [
    '/offline',
    '/logo/favicon.svg',
    '/build/{{ $manifest["resources/css/app.css"]["file"] }}',
    '/build/{{ $manifest["resources/js/app.js"]["file"] }}',
];

self.addEventListener("install", event => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
        .then(cache => cache.addAll(filesToCache))
    );
});

self.addEventListener("activate", event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                .filter(name => name.startsWith("pwa-") && name !== staticCacheName)
                .map(name => caches.delete(name))
            );
        })
    );
});

self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
        .then(response => {
            return response || fetch(event.request);
        })
        .catch(() => {
            if (event.request.mode === 'navigate') {
                return caches.match('/offline');
            }
        })
    );
});
