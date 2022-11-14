# PHP - Autentificació amb pdo
## DAW-MP07-UF3 - Exercici de Tècniques d’accés a dades.
Modifica el formulari d'autentificació de la [Prova de l'UF1](https://github.com/aniollidon/gitbook-php/tree/master/activitats/DAW-MP07/DAW-MP07-UF1/prova-uf1 ) de manera que les dadedes dels usuaris i l'escriptura de les connexions es faci a la base de dades enlloc de a un fitxer JSON.

Per fer això caldrà crear una base de dades tal i com hem vist a l'exercici [PHP - Accés a dades amb PDO](/activitats/DAW-MP07/DAW-MP07-UF3/php-acces-a-dades-amb-pdo/readme.md). 

1. Evita l'sql injection tal i com hem vist a l'exercici [PHP - Inserció de dades amb PDO](/activitats/DAW-MP07/DAW-MP07-UF3/php-insercio-de-dades-amb-pdo/readme.md)
2. Recorda crear la clau primària de la taula. i que les contrassenyes mai s'emmagatzemen en text pla, cal fer una transformació hash de les mateixes, per exemple amb MD5. 

+ L'usuari i contrasenya de la base de dades ha de ser "dwes-user" i "dwes-pass". La base de dades creada s'ha de dir "dwes-nomcognom-autpdo".
+ Cal penjar també el fitxer sql que crea la base de dades.

---

#FpInfor #Daw #DawMp07 #DawMp07Uf03

* Resultats d'aprenentatge 1.b 1.c 1.d 1.e
* Continguts 1.2 1.3 1.4 1.5
---

###### Autor: Aniol Lidon 2022.11.31 
###### [CC BY](https://creativecommons.org/licenses/by/4.0/) ![CC BY](https://licensebuttons.net/l/by/3.0/80x15.png)