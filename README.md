# tesztfeladat_OL
Bebesi András tesztfeladat megoldás az OL Munkaidő Kft.-nek

Telepítés:
1. lépés:
Leklónozni a projektet a githubról.

2. lépés:
Elinditani egy mysql szervert.

3. lépés:
Átírni a .env fájlba az adatbázis elérhetőségét és szükségesetén a nevét.

4. lépés:
a cmd-be a következő parancsokat futtasa le:

cd [projekt elérési útja]/tesztfeladat_OL

php bin/console doctrine:database:create

5.lépés 
php bin/console doctrine:migrations:migrate

6.lépés 
worker.sql fájl importálása az adatbázisba

7.lépés
cmd-be ez a parancs lefuttatása
symfony server:start

8.lépés
http://localhost:8000 megnyitása a böngészőben.
