var staticCacheName = "pwa-v" + new Date().getTime();

var filesToCache = [
    "{{ route('offline') }}",
    "/build/assets/app-CHWmdedT.css",
    "/build/assets/app-BOnbAkpD.js",
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