// Service Worker Kill Switch
self.addEventListener('install', event => {
    self.skipWaiting();
    console.log('SW: Kill switch installed.');
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    console.log('SW: Deleting cache', cache);
                    return caches.delete(cache);
                })
            );
        }).then(() => {
            console.log('SW: All caches deleted.');
            return self.clients.claim();
        })
    );
});

self.addEventListener('fetch', event => {
    // Pass through to network, no caching
    event.respondWith(fetch(event.request));
});
