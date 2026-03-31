# InfinityFree Deploy Checklist

## Target

Deploy this LMS inside:
`/htdocs/library`

This keeps it isolated from your existing Wed Lock project.

## Steps

1. Upload project files to `htdocs/library`.
2. Open `config/app.php` and set exact DB credentials from InfinityFree panel.
3. Import `database/library_management_patch.sql`.
4. Open:
`https://sobran.lovestoblog.com/library/User/index.php`
5. Initialize admin once:
`https://sobran.lovestoblog.com/library/Admin/seed_admin.php`
6. Delete `Admin/seed_admin.php` after successful setup.

## Verify

- User signup/login works.
- Admin login works with:
- Email: `shiroonigami23@gmail.com`
- Password: `shiro`
- Footer links show GitHub and LeetCode.
- No Facebook/Instagram links in footer.
