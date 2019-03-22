# Doctrine Bundle Project
###Doctrine Bundle Project - Symfony 4+

___Version 0.0.08___

This project has not yet implemented a flex recipe.

###Usage
This project adds a prefix to all tables names within a connection.  In your __doctrine.yaml__ definition, add the prefix under the options of the connection.

```
doctrine:
    dbal:
        default_connection: default
        # configure these for your database server
        connections:
            default:
                driver: 'pdo_mysql'
                server_version: '5.7'
                charset: utf8mb4
                default_table_options:
                    charset: utf8mb4
                    collate: utf8mb4_unicode_ci
                options:
                    prefix: 'test_'
                url: '%env(resolve:DATABASE_URL)%'
            oauth:
                driver: 'pdo_mysql'
                server_version: '5.7'
                charset: utf8mb4
                default_table_options:
                    charset: utf8mb4
                    collate: utf8mb4_unicode_ci
                options:
                    prefix: 'oauth2'
                url: '%env(resolve:DATABASE_URL2)%'

```

Each connection will then add the prefix (of maximum 7 characters) to the front of every table that meets the connection settings.  In this case 'test_' will be added to all tables names in the default connection, and 'oauth2' will be added to tables identified by the oauth connection. 

##Installation
####Applications that use Symfony Flex
Open a command console, enter your project directory and execute:

```$ composer require crayner/doctrine-bundle```

####Applications that don't use Symfony Flex
Step 1: Download the Bundle
    Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```$ composer require crayner/doctrine-bundle```

This command requires you to have Composer installed globally, as explained in the installation chapter of the Composer documentation.

Step 2: Enable the Bundle
    Then, enable the bundle by adding it to the list of registered bundles in the config/Bundles.php file of your project:
```
<?php

return [
    //...
    //
    Crayner\Doctrine\CraynerDoctrineBundle::class => ['all' => true],
];
```

Licence: [MIT](LICENCE.md)