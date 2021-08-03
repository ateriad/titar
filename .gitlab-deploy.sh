cd /var/apps/titar
git reset --hard HEAD^
git pull
docker exec titar_php composer install
docker exec titar_php php artisan migrate --force
exit
