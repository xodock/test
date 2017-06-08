# test project fo Solar Digital
Dev deploy instruction:

1. composer require laravel/homestead --dev
7. do "npm install"
8. do "npm run dev"
2. 
linux: do
"php vendor/bin/homestead make"
windows: do
"vendor\\bin\\homestead make"
3. do "vagrant up"
4. run ssh connection to vm
5. do in vm "cd ~/Code/test-solar"
6. do in vm "php artisan migrate"
9. open in browser http://192.168.10.10/