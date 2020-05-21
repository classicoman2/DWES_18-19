# biblio_mvc

Database:  biblio_mvc_database
User, password en XAMPP:  root, ""

Al directori config/global.php s'hi estableix el directori local/remot en el camp de l'array  "directori_arrel" juntament amb altres constants de configuració de l'app.



## TODO
* Que a partir de valor en global.php, pugui triar implementació de la cistella
  de la compra entre "session", si empro $_SESSION per guardar la cistella (i aquesta
  només es guarda mentre dura la sessió) o $_COOKIE si empro cookies, les quals estan
  associades a un usuari i se pot establir el temps de durada fàcilment, p.ex un dia (o
  més, com fa Amazon)

* FET! Clean Urls pels llibres: fa falta un codi generador d'aquestes clean urls i també
  configurar el fitxer .htaccess del Servidor Virtual de Apache per a que redirigeixi.

* Fer pantalla 404 estandard, codi: todo001 (buscar el que s'ha de canviar amb aquest codi)
