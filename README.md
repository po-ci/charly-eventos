ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application.

Installation
------------

Using Composer (recommended)
----------------------------


Using Git submodules
--------------------
Alternatively, you can install using native git submodules:



### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName asd.localhost
        DocumentRoot /path/to/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
