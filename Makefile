SHELL := /bin/bash

# --- Detecta l'usuari que executa 'make'
UID := $(shell id -u)
GID := $(shell id -g)

# --- S'estableix la versió manualment de PHP (revisar per a futures actualitzacions)
PHP_VERSION ?= 8.4

# Versió de PHP que volem que respecti Composer (la fem igual que la del contenidor)
PHP_PLATFORM ?= $(PHP_VERSION)

# Versió de Laravel
#LARAVEL_VERSION ?= ^11.0
LARAVEL_VERSION ?= ^12.0

# ----------------------------------------------------
# AJUDA (mostrar llista de comandes disponibles)
# ----------------------------------------------------

help:
	@echo ""
	@echo "Comandes disponibles:"
	@echo "-----------------------------------------"
	@echo " make up              -> Arrenca tots els serveis (web, laravel, mysql, phpmyadmin...)"
	@echo " make down            -> Para i elimina contenidors (manté les dades)"
	@echo " make build           -> Reconstrueix les imatges des de zero"
	@echo " make restart         -> Reinicia tots els serveis"
	@echo " make logs            -> Mostra els últims logs dels contenidors"
	@echo ""
	@echo " make laravel-new     -> Crea un nou projecte Laravel dins de app/laravel"
	@echo " make art cmd=\"...\"  -> Executa una comanda Artisan (ex: make art cmd=\"about\")"
	@echo " make npm cmd=\"...\"  -> Executa una comanda NPM (ex: make npm cmd=\"run dev\")"
	@echo ""
	@echo " make clean           -> Elimina contenidors antics o duplicats (sense perdre dades)"
	@echo " make dump-db         -> Fes una còpia de seguretat de totes les BDs a backup-YYYY-MM-DD.sql"
	@echo " make restore-db      -> Restaura l'últim fitxer de backup trobat"
	@echo " make clean-containers -> Elimina tots els contenidors existents"
	@echo " make remove-container NAME=\"...\" -> Elimina el contenidor que li passes el nom per paràmetre"
	@echo "-----------------------------------------"
	@echo "Pots executar 'make <comanda>' per iniciar qualsevol acció."
	@echo ""

# ----------------------------------------------------
# BÀSIQUES
# ----------------------------------------------------

# Comprova i crea el volum MySQL si no existeix
check-volume:
	@if ! docker volume inspect php-basic_mysql-data >/dev/null 2>&1; then \
		echo "El volum php-basic_mysql-data no existeix. Creant-lo..."; \
		docker volume create php-basic_mysql-data >/dev/null; \
	else \
		echo "Volum php-basic_mysql-data ja existent."; \
	fi

# Arrencar els serveis (crea volum si cal)
up: check-volume
	docker compose up -d

down:
	docker compose down

build:
	docker compose build --build-arg PHP_VERSION=$(PHP_VERSION) web_laravel	

restart: down up

logs:
	docker compose logs -f --tail=200

# ----------------------------------------------------
# Eines Laravel / PHP
# ----------------------------------------------------

# Composer en contenidor (treballant sobre la carpeta app/)
COMPOSER_BASE := docker run --rm -u $(UID):$(GID) -v "$(PWD)/app":/app composer:2
COMPOSER      := $(COMPOSER_BASE) -d /app
COMPOSER_APP  := $(COMPOSER_BASE) -d /app/laravel

# Eines dins del contenidor web laravel
ARTISAN  := docker compose exec -T --user $(UID):$(GID) web_laravel php artisan
NPM      := docker compose exec -T --user $(UID):$(GID) web_laravel npm

# Crear (o recrear) el projecte Laravel del curs a app/laravel
# “make laravel-new esborra el projecte actual de app/laravel i en crea un de nou.
# Si voleu conservar un projecte, renombreu la carpeta abans (app/laravel_bk, etc.).”
laravel-new:
	@echo ">>> Esborrant projecte antic (si existeix): app/laravel"
	rm -rf app/laravel
	@echo ">>> Creant projecte Laravel $(LARAVEL_VERSION) a app/laravel"
	$(COMPOSER) create-project "laravel/laravel:$(LARAVEL_VERSION)" "laravel"
	@echo ">>> Fixant plataforma PHP a $(PHP_PLATFORM) per evitar incompatibilitats"
	$(COMPOSER_APP) config platform.php $(PHP_PLATFORM)
	@echo ">>> Actualitzant dependències respectant PHP=$(PHP_PLATFORM)"
	$(COMPOSER_APP) update



# Executar ordres Artisan (ex: make art cmd="about")
art:
	docker compose exec -T --user $(UID):$(GID) web_laravel bash -lc 'cd /var/www/html/laravel/ && php artisan $(cmd)'

# Executar ordres NPM (ex: make npm cmd="run dev")
npm:
	docker compose exec -T --user $(UID):$(GID) web_laravel bash -lc 'cd /var/www/html/laravel/ && npm $(cmd)'

# Executar ordres Composer dins del contenidor (ex: make composer cmd="require laravel/breeze --dev")
composer:
	docker run --rm -u $(UID):$(GID) -v "$(PWD)/app":/app -w /app composer:2 $(cmd)


# ----------------------------------------------------
# NETEJA I BACKUPS
# ----------------------------------------------------

MYSQL_C := php-basic-mysql
MYSQL_ROOT_PW := root

# Elimina contenidors antics en conflicte (sense tocar dades)
clean:
	@echo "Comprovant contenidors amb noms duplicats..."
	@for c in php-basic-web php-basic-web_laravel php-basic-mysql php-basic-code php-basic-pma; do \
		if docker ps -a --format '{{.Names}}' | grep -q $$c; then \
			echo "Eliminant $$c..."; \
			docker stop $$c >/dev/null 2>&1 || true; \
			docker rm $$c >/dev/null 2>&1 || true; \
		fi \
	done
	@echo "Neteja completada. Volums i dades de MySQL conservats."

# Còpia de seguretat de totes les bases de dades
dump-db:
	docker exec -i $(MYSQL_C) mysqldump -uroot -p$(MYSQL_ROOT_PW) --all-databases --single-transaction --routines --triggers > backup-`date +%F`.sql
	@echo "Backup creat: backup-`date +%F`.sql"

# Restaura l'últim backup trobat
restore-db:
	@ls -t backup-*.sql 2>/dev/null | head -n 1 | xargs -I {} sh -c 'cat "{}" | docker exec -i $(MYSQL_C) mysql -uroot -p$(MYSQL_ROOT_PW)'
	@echo "Últim backup restaurat correctament."

# Elimina contenidors aturats i xarxes no utilitzades
prune:
	docker container prune -f
	docker network prune -f
	@echo "Contenidors i xarxes no utilitzades eliminats (les dades de MySQL es conserven)."

## (opcional) arreglar permisos amb cd previ
fix-perms:
	@echo ">>> Fixant permisos i netejant caches per a /var/www/html/laravel"
	docker compose exec -T -w /var/www/html/laravel web_laravel bash -lc '\
	  mkdir -p storage/framework/{cache,views,sessions} bootstrap/cache && \
	  chmod -R 777 storage bootstrap/cache && \
	  php artisan view:clear && \
	  php artisan cache:clear && \
	  php artisan config:clear \
	'

clean-containers:
	@CONTAINERS=$$(docker ps -aq); \
	if [ -z "$$CONTAINERS" ]; then \
		echo "No hi ha contenidors per eliminar."; \
	else \
		echo "Eliminant contenidors aturats..."; \
		docker rm -f $$CONTAINERS >/dev/null 2>&1 || true; \
		echo "Contenidors eliminats correctament."; \
	fi

remove-container:
	@if [ -z "$(NAME)" ]; then \
		echo "Cal indicar el nom del contenidor. Exemple: make remove-container NAME=php-laravel-web"; \
		exit 0; \
	fi; \
	if docker ps -a --format '{{.Names}}' | grep -q "^$(NAME)$$"; then \
		echo "Eliminant contenidor: $(NAME)"; \
		docker rm -f $(NAME) >/dev/null 2>&1 || true; \
		echo "Contenidor eliminat correctament."; \
	else \
		echo "No existeix cap contenidor amb el nom: $(NAME)"; \
	fi
