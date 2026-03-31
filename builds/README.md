# APK and EXE Build Guide

## 1) Android APK (PWA/TWA)

Use your hosted URL, for example:
`https://your-domain/library/User/index.php`

Steps:

1. Ensure HTTPS is active on your domain.
2. Keep `manifest.webmanifest` and `sw.js` accessible.
3. Use Bubblewrap:
- `npm i -g @bubblewrap/cli`
- `bubblewrap init --manifest https://your-domain/library/User/manifest.webmanifest`
- `bubblewrap build`
4. Generated APK/AAB will be in Bubblewrap output folder.

## 2) Windows EXE (Nativefier)

1. Install Node.js.
2. Run:
- `npm i -g nativefier`
- `nativefier --name "LMS Pro" --single-instance --maximize "https://your-domain/library/User/index.php"`
3. The generated folder contains your `.exe`.

## Notes

- APK/EXE are wrappers of your hosted site, not standalone PHP runtime binaries.
- Keep backend hosted and database online for full functionality.
