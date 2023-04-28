# bcso-lspd-intranet
Un intranet BCSO-LSPD standalone

Dans chaque dossier vous trouverez un site web (BCSO/LSPD)
Pensez à importer le modèle SQL dans votre moteur de gestion de base de donnée et de configurer les fichiers de configuration php

## Configuration
- Créer un fichier config.php dans les dossiers BCSO ET LSPD en utilisant le modèle ci-dessous :
```php
<?php
$username = "user"; // username
$password = "pass"; // password of the database
$hostname = "localhost"; // host of the database
$namebase = "database"; // name of the database

try
 {
  $bdd = new PDO('mysql:host='.$hostname.';dbname='.$namebase.'', $username, $password);
 }
  catch (Exception $e)
 {
  die('Erreur : ' . $e->getMessage());
 }
 ?>

```
- Importer le modèle de base de donnée