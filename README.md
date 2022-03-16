# DbBundle

DbBundle est un simple bundle permettant d'ajouter un préfixe aux tables.

## Installation
Ajouter (ou modifier)
```
    "repositories": {
        "db-bundle": {
            "type": "vcs",
            "url": "git@github.com:DelPlop/sf-db-prefix-bundle.git"
        }
    },
```
dans `composer.json` de votre projet puis exécuter `composer require delplop/dbbundle`.

UserBundle sera disponible en tant que vendor.

## Configuration
Ajouter
```
services:
    delplop_db.subscriber.table_prefix:
        class: DelPlop\DbBundle\Subscriber\TablePrefixSubscriber
        arguments:
            $prefix: 'sf_'
        tags: [ 'doctrine.event_subscriber' ]
```
dans `config/services.yaml` de votre projet et changer la variable `$prefix`
