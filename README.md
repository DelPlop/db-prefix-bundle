# DbBundle

DbBundle est un simple bundle permettant d'ajouter un préfixe aux tables.

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
dans `config/services.yaml` de votre projet
