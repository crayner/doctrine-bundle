# Doctrine Bundle Project
## Table Prefix Configuration

### Usage
This project adds a prefix to all tables names within doctrine or per connection.
* In the __config/packages/crayner_doctrine.yaml__ file set the prefix option.
```yaml
crayner_doctrine:
    prefix: jhg6_
```
* In your __config/packages/doctrine.yaml__ definition, add the prefix under the options of the connection. This option has a higher priority that the prefix set in the bundle configuration.

```yaml
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
                url: '%env(resolve:DATABASE_URL)%'
            oauth:
                driver: 'pdo_mysql'
                server_version: '5.7'
                charset: utf8mb4
                default_table_options:
                    charset: utf8mb4
                    collate: utf8mb4_unicode_ci
                options:
                    prefix: 'aoauth2'
                url: '%env(resolve:DATABASE_URL2)%'

```
The prefix, regardless of where it is set,  is limited to 7 characters maximum and all whitespace is removed.

Each connection will then prefix (maximum 7 characters) every table that meets the connection settings.  In this case **'jhg6_'** will be added to all tables names in the default connection, and __'oauth2'__ will be added to tables identified by the oauth connection.  The listener will add the prefix whenever the table is actioned via doctrine.

__Limitation__
* The prefix is not available in the Migration Bundles.

[Return Home](../README.md)