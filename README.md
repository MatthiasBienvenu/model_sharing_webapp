# model_sharing_webapp
Project for the CSC4101 module where people can share AI models.

# Classes

User
- name
- email

Model
- name
//- visibility
- pytorch code
- model visualization


Inventory

Showcase
- name

# Installation

Install symfony
```bash
sudo apt install symfony-cli # on Debian
```

Install symfony project dependencies
```bash
symfony composer install
```

# Useful commands

```bash
# create the database file and generate the tables and index
symfony console doctrine:database:create
symfony console doctrine:schema:create
```

```bash
# tries to update the tables and index without removing data
symfony console doctrine:schema:update
```

```bash
# removes everything and regenerates the entire database
symfony console doctrine:database:drop --force
symfony console doctrine:database:create
symfony console doctrine:schema:create
```

```bash
# load the test data
symfony console doctrine:fixtures:load
```
