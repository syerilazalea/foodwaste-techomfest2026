var staticCacheName = "pwa-v" + new Date().getTime();

var filesToCache = [
    "/offline",
    "/logo/favicon.svg"
];

self.addEventListener("install", event => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName).then(async cache => {
            for (const file of filesToCache) {
                try {
                    await cache.add(file);
                } catch (e) {
                    console.warn("Gagal cache:", file, e);
                }
            }
        })
    );
});

self.addEventListener("activate", event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-v")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
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
                return caches.match('/offline');
            })
    );
});
