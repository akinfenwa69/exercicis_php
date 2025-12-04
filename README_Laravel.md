# Entorn PHP + Laravel amb Docker

Aquest entorn permet treballar tant amb PHP bàsic com amb **Laravel**, dins d’una mateixa infraestructura amb **Docker**.  
Inclou serveis per a PHP, MySQL, phpMyAdmin i Laravel, de manera que no cal instal·lar res més.

**IMPORTANT**: Heu de descomprimir la recepta proporcionada "php-Laravel.zip" a la ruta /srv/. Es a dir, ara tindreu dues carpetes la php-basic i la de php-Laravel.  Per a programar amb Laravel utilitzarem aquesta última.

A banda, abans de utilitzar aquesta nova recepta haureu de parar els contenidors de la carpeta "php-basic" per evitar conflictes de ports. Per això us situareu a /srv/php-basic i allí fareu:


```bash
make down
```

---

## Estructura del projecte
```
.
├─ docker-compose.yml
├─ Makefile
├─ README.md
├─ app/
│  ├─ index.php              # Projecte PHP bàsic
│  └─ laravel/               # Projecte Laravel
└─ docker/
   └─ web/
      ├─ Dockerfile
      └─ php-dev.ini
```

---

## Ús ràpid de l’entorn

### 1. Arrencar l’entorn

Important parar abans els contenidors de "l'antiga recepta" a /srv/php-basic!
Després a /srv/php-Laravel com a **root** fer:

```bash
make up
```

Serveis disponibles:
- Web PHP:       http://localhost:8000  
- Web Laravel:   http://localhost:8001  
- phpMyAdmin:    http://localhost:8080  (usuari: root / contrasenya: root)  
- Code Server:   http://localhost:8081  (contrasenya: alumnat)

---

### 2. Crear un projecte Laravel

Aquesta comanda crea el projecte **com a root** dins `app/laravel` i assegura que tingui tots els permisos correctes:

```bash
make laravel-new
make fix-perms
```

És important executar-la amb **l’usuari root** (per exemple, dins la màquina Vagrant com a root).  
Si no es fa així, Laravel pot crear fitxers amb permisos restringits i el servidor no podrà accedir-hi.

---

### 3. Configurar la connexió amb MySQL

Abans de provar Laravel, cal editar el fitxer `app/laravel/.env` i comprovar que hi ha aquesta configuració:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=projecte
DB_USERNAME=user
DB_PASSWORD=secret
SESSION_DRIVER=file

```

Això connecta Laravel amb el servei MySQL del Docker.  
Per defecte, Laravel intenta utilitzar SQLite, però amb aquests valors es farà servir la base de dades MySQL del vostre entorn.

---

### 4. Generar la clau d’aplicació i netejar caches

Un cop creat el projecte i configurat `.env`, cal generar la clau interna de Laravel i buidar les caches.  
Això és necessari perquè Laravel funcioni correctament amb la nova configuració:

```bash
make art cmd="key:generate"
make art cmd="config:clear"
make art cmd="cache:clear"
make art cmd="view:clear"
```

---

### 5. Comandes útils

| Acció                                                    | Comanda                              |
| -------------------------------------------------------- | ------------------------------------ |
| Arrencar els serveis                                     | `make up`                            |
| Aturar i eliminar contenidors                            | `make down`                          |
| Reconstruir les imatges                                  | `make build`                         |
| Reiniciar serveis                                        | `make restart`                       |
| Veure logs                                               | `make logs`                          |
| Crear projecte Laravel                                   | `make laravel-new`                   |
| Executar comandes Artisan                                | `make art cmd="comanda"`             |
| Executar comandes NPM                                    | `make npm cmd="comanda"`             |
| Executar comandes Composer                               | `make composer cmd="comanda"`        |
| Corregir permisos de Laravel                             | `make fix-perms`                     |
| Netejar contenidors antics                               | `make clean`                         |
| Crear una còpia de seguretat de la BD                    | `make dump-db`                       |
| Restaurar l’última còpia de seguretat                    | `make restore-db`                    |
| Mostrar ajuda amb totes les opcions                      | `make help`                          |
| Elimina tots els contenidors existents                   | `make clean-containers`              |
| Elimina el contenidor que li passes el nom per paràmetre | `make remove-container NAME=\"...\"` |

---

### 6. Provar Laravel després de la integració

1. Obrir el navegador a:  
   `http://localhost:8001`  
   Si tot està correcte, apareixerà la pàgina de benvinguda de Laravel.

2. Crear una ruta de prova al fitxer `app/laravel/routes/web.php`:
   ```php
   use Illuminate\Support\Facades\Route;

   Route::get('/', fn () => 'Hola Laravel 12!');
   Route::get('/hola', fn () => 'Hola Món!');
   ```
3. Tornar a carregar la pàgina del navegador:
   - `http://localhost:8001` → mostra “Hola Laravel 12!”
   - `http://localhost:8001/hola` → mostra “Hola Món!”

---

### 7. Comprovar la connexió amb la base de dades

Executa una primera migració per comprovar que Laravel pot connectar-se amb MySQL i crear les seves taules internes:

```bash
make art cmd="migrate"
```

Aquesta comanda crea les taules bàsiques (`users`, `migrations`, etc.) que Laravel inclou per defecte i confirma que la connexió amb la base de dades és correcta.
Si no apareix cap error, l’entorn ja està preparat per començar a treballar amb models i migracions pròpies.

---

### 8. Fer còpies de seguretat

Per crear una còpia de seguretat de totes les bases de dades:
```bash
make dump-db
```

El fitxer de còpia (`backup-YYYY-MM-DD.sql`) es guarda a la mateixa carpeta del projecte.

Per restaurar-lo:
```bash
make restore-db
```
---

### 9. Gestió de diversos projectes Laravel

El projecte Laravel es crea per defecte dins `app/laravel`.
El servidor web del contenidor mostra sempre el contingut de `app/laravel/public`, per tant només un projecte pot estar actiu i visible al navegador alhora.

Tot i això, es poden tenir diversos projectes guardats dins la carpeta `app/`, simplement canviant el nom de cadascun.
Canviar el nom **no afecta namespaces ni configuracions internes** de Laravel.

#### Exemple d’ús

Guardar un projecte i crear-ne un altre:

```bash
mv app/laravel app/laravel-grup1
make laravel-new
make fix-perms
```

Tornar a activar un projecte anterior:

```bash
rm -rf app/laravel
mv app/laravel-grup1 app/laravel
make fix-perms
```

D’aquesta manera es poden tenir diversos projectes guardats (`laravel-grup1`, `laravel-api`, `laravel-prova`, etc.).
Només cal que el projecte que es vulgui veure al navegador es digui `laravel`.
El servidor mostrarà sempre el que estigui dins `app/laravel/public` a l’adreça:

```
http://localhost:8001
```

---

Aquí tens el **nou apartat completament redactat** i una **nota final per a l’alumnat**, integrats perquè els puguis enganxar directament al teu README.
Tot està redactat en **tercera persona**, amb **to docent**, **sense icones** i coherent amb l’estil del document.

Et marco on s’ha d’inserir cada part.

---

### **10. Canviar de versió de PHP i Laravel**

En alguns moments pot ser necessari actualitzar l’entorn a una versió més recent de Laravel o de PHP. Aquest procés s’ha de fer sempre de manera controlada perquè Laravel i PHP siguin compatibles i perquè la recepta continuï funcionant correctament.

A continuació s’explica com fer el canvi de versió de manera ordenada.

#### **10.1. Actualitzar Laravel a una nova versió major**

Si en un futur es vol utilitzar una versió posterior de Laravel (per exemple, Laravel 13), cal modificar el valor que apareix al Makefile:

```
LARAVEL_VERSION ?= ^13.0
```

Aquest canvi farà que, en executar `make laravel-new`, es generi un projecte Laravel basat en la nova versió.

#### **10.2. Actualitzar PHP per garantir compatibilitat**

Cada nova versió de Laravel pot requerir una versió concreta de PHP.
Per aquest motiu, sempre que es canviï la versió de Laravel, s’ha de modificar també la versió de PHP que utilitza la recepta.

Al Makefile cal actualitzar:

```
PHP_VERSION ?= 8.x
```

on “8.x” ha de ser la versió mínima de PHP compatible amb la versió de Laravel triada.

Després de modificar aquesta línia, s’ha de reconstruir l’entorn:

```
make down
make build
make up
```

Aquest procés assegura que els contenidors es tornin a generar amb la nova versió de PHP i que el projecte sigui compatible amb la nova versió de Laravel.

---


### 11. Notes finals

* Sempre que es creï un projecte nou Laravel cal fer-ho amb **root** i després aplicar `make fix-perms`.
* Les dades de MySQL es conserven automàticament al volum `php-basic_mysql-data`.
* No cal entrar dins els contenidors: totes les comandes es poden fer directament des de l’entorn local o la màquina Vagrant.
* Si hi ha errors de permisos o “permission denied”, repetir `make fix-perms` assegurant-se que el projecte és propietat de root.
* Si Laravel mostra un error d’SQLite, cal revisar el fitxer `.env` i confirmar que utilitza MySQL.
* Quan es treballi amb noves versions de Laravel o es modifiqui el Makefile, sempre s’ha de comprovar quina versió de PHP és compatible amb la versió escollida de Laravel. Si apareixen errors de compatibilitat després d’una actualització, s’ha de revisar l’apartat dedicat al canvi de versió d'aquest Readme (**punt 10**) de Laravel  i PHP, i assegurar que ambdues versions coincideixen amb els requisits oficials del framework. 

---