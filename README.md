Velkommen til mit eksamensprojekt SkateCraft

Opsætning

Windows:

Hvis du vil teste register funktionen, skal du opsætte din .env med mailtrap.io

Ellers benyt dig af test brugerne 
Username: user1@example.com
Password: password

Til admin login - skriv "/admin/login" i url
Username: admin1@example.com   
Password: password

1. Sørg for at du har php, node, npm, mysql server, laravel, composer, xampp (til at køre localhost server) installeret på din computer
2. Flyt github repositoriet ind i htdocs i xampp
3. Opret MySQL database
4. Opdater .env filen med dine database konfirgurationer
5. Kør command "composer update"
5. Kør command "composer install"
6. Kør command "npm ci"
7. Kør command "php artisan key:generate"
8. Kør command "php artisan migrate --seed"
9. Flyt 3D filer som er tilknyttet ind i /storage/app/public/models
10. Kør command "php artisan storage:link"
10. Kør command "npm run build"
12. Kør command "php artisan serve"


Mac:
Sørg for at du har php, node, npm, mysql server, laravel, composer installeret på din computer.
På mac kan man bruge værktøjet "Herd" - der bliver opsat en herd mappe i din user fil, og i denne herd fil kan opsættes flere projekter i forskellige mapper

Herd står for at køre din localhost server
Guide til at opsætte herd - https://www.youtube.com/watch?v=w-cebRYZH9E

Når projektet er i Herd mappen, går du igennem terminal ind i projekt mappen og skriver "npm run dev"

Hvis du vil teste register funktionen, skal du opsætte din .env med mailtrap.io - Opdater mail variabler i bunden af .env filen

Ellers benyt dig af test brugerne 
Username: user1@example.com
Password: password

Til admin login - skriv "/admin/login" i url
Username: admin1@example.com   
Password: password

1. Kør command "npm ci"
2. Kør command "composer install"
3. Opsæt Mysql database på din computer
4. Opdater .env filen til at benytte sig at dit database konfirguration
5. Opdater APP_URL i .env fil til hvad mappen hedder i herd mappen f.eks. https://skater.test
6. Åben herd og ændre i konfirgurationer (billede af en hængelås) og tryk på den for at benytte https på det projekt
5. Kør command "php artisan key:generate"
4. Kør command "php artisan migrate --seed"
9. Flyt 3D filer som er tilknyttet ind i /storage/app/public/models
1. Kør command "npm run dev"



