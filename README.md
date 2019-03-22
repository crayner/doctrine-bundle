# Doctrine Bundle Project
###Doctrine Bundle Project - Symfony 4+
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


