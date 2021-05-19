# cron job
* * * * * {path ke php}/php {path ke aplikasi}/artisan schedule:run >> /dev/null 2>&1

# command
php artisan migrate
php artisan storage:link


# permission
/public/
/storage/