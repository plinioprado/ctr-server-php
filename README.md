# Finance control backend and REST API in PHP 

This is one back end version of the TwsLite finance software, its business logic and modelling, made public in 2017.

Modules
* a (Adm): Administration
* b (Ban): Cash management
* c (Ctr): Accounting, finance and managerial reports
* p (Pay): Accounts payable
* r (Rec): Accounts receivable
* m (Mnt): Maintenance and support

The code reflect Brazilian financial best practicies and models, and was the base of jobs in management, consulting and development of special softwares. There is also a TwsFull version, structured in double entry transations.

Some additional docs (in Portuguese) at ./README2.md

## Stack

Technologies
* PHP
* REST API
* MySQL

Layers
* User interfaces:
  * Tratitional PHP (index.php) rendering under a login session
  * REST API (although not REST full, in imp, mnr and public folders), servind clients (other Projects) requests under a token session
* Business logic (b*.php files): Based in PHP Classes plus OOP concepts and practices learned fron C#
* Data access (d*.php files): Classic PHP/MySQL 

## Install

This code is intended primarely to be used as a reference, but can be installed through:

* Upload the files in a web server who supports PHP
* Install the MySQL database from the folder /dbinstall
* Replace 'xxxxxx' from the connection code in d.php by the connection data of the installed MySQL

## Collaboration and quesitons

Contact plinio.prado@immaginare.com.br
