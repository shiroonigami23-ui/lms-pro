const CACHE_NAME = "lms-pro-v2";
const urlsToCache = [
  "./index.php",
  "./user_login.php",
  "./signup.php",
  "./about_us.php",
  "../bootstrap-4.4.1/css/bootstrap.min.css"
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(urlsToCache))
  );
});

self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => response || fetch(event.request))
  );
});
