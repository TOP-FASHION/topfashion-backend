#!/bin/bash
echo -e "\nSto avviando la procedura di startup dell'ambiente locale con la copia \ndell'ultimo database disponibile dall'ambiente remoto \n\n\n"
echo -e "Assicurati di aver abilitato la vpn verso la rete interna di unica.it"

sleep 3

echo -e "\nEseguo docker-compose down"
docker-compose down
sleep 1
echo -e "\nImporto l'ultimo database da produzione"

#Sincronizzo in db da produzione
rm mariadb-init/backup.sql
scp dhwp@90.147.144.144:/home/dhwp/dump-db/backup.sql mariadb-init/backup.sql

echo -e "\nAssicurati di aver committato eventuali modifiche perché tra 10 secondi farò switch su master"
sleep 5

echo -e "\nAncora 5 secondi ed eseguo lo switch"

#Eseguo switch su branch master
#git fetch --all
#git checkout master
sleep 3

echo -e "\nEseguo il git pull"

git pull origin master

echo -e "\nFaccio ripartire tutti i container in locale"

./dev.sh up

echo -e "\nAspetto 1 minuto perché sto importando il db di produzione"
sleep 2
echo -e "\nIn caso di errore è sufficente aumentare il tempo di attesa dell'importazione"
sleep 50
echo -e "\nOk db importato"
sleep 2
echo -e "\nImposto wordpress per lo sviluppo locale"

# Posso inserire qui i plugin da disabilitare
# wp plugin deactivate really-simple-ssl
# wp option update home 'http://dh.unica.localhost'
# wp option update siteurl 'http://dh.unica.localhost'

wp search-replace --url=dh.unica.it dh.unica.it dh.unica.localhost 'wp_*options' wp_blogs
echo -e "\nOk! Database impostato per l'ambiente di sviluppo"
sleep 5

echo -e "\nResetto le password di amministrazione\nAdesso accedi con admin:admin mentre tutte le altre utenze rimangono le stesse"

wp user update 1 --user_pass=admin
sleep 2
echo -e "\nProcedura completata. Vai all'indirizzo http://dh.unica.localhost/wp-login.php"
