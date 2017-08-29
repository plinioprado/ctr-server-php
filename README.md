# TwsLite Back end - PHP version

This is one back end version  of the TwsLite project made public in 2017.

The code reflect Brazilian financial best practicies and models, and was the base of jobs in management, consulting and development of special softwares.

There is also a Full version, different from this Lite for allowing double entry transations.

If there is anyone people interested in the use for a finance module for a ERP or business software, feel free to use it and ask questions to plinio.prado@immaginare.com.br

## Stack

* PHP
* REST API
* MySQL

## Install

This code is intended primarely to be used as a reference, but can be installed through:

* Upload the files in a web server who supports PHP
* Install the MySQL database from the folder dbinstall
* Replace the 'xxxxxx' from the connection code in d.php by thhe connection data of the installed MySQL
* Use:
** As rest service in /api.php
** As import and export in /imp/
** Through PHP front end in /mnt/ 

There is an instance currently working and stable

## Portuguese original docs

### Introdução:

Back end desenvolvido em PHP

### Camadas

 - u (Uil): User interface layer.
 Http/Rest/Json (hoje parcial e evoluindo para full). Normalmente composta pelo 'index.php'eventualmente complementada pelos pelos arquivos com nome iniciado por 'u'. Existe uma interface secundária PHP não Rest no folder 'mnt' para algumas funcionalidades de manutenção.
 
 - b (Bll): Business logic layer.
 Contém os objetos e serviços em metoldologia OOP que está evoluindo. Normalmente composta pelos arquivos com nome iniciado por 'b':

 - d (Dal): Data Access layer.
 Hoje se conecta a um conjunto de bases Mysql, uma para cada cliente, e depois poderá ser ampliada para outras. Normalmente composta pelos arquivos com nome iniciado por 'd':


### Módulos

Distribuídos pelas sequintes áreas:

 - a (Adm):  Administração
 - b (Ban): Gestão de caixa
 - c (Ctr): Controladoria, demonstrativos e relatórios para Análise e planejamento 
 - p (Pay): Contas a pagar
 - r (Rec): Contas a receber
 - m (Mnt): Manutenção e suporte


### Base do modelo:

Versão simplificada da modelagem de transações Tws que controla em partidas dobradas as movimentações de:

    RecIns (Emissão de C.receber) -> RecMov (Movimento de C.receber) -> RecBan (Recebimento) -> BanMov (conta corrente)

Posteriormente, o controle de C.receber será replicado para C.pagar. 


### Arquivos:

Uil

 - index.php: UIL
 - imp/index.php: UIL não Http/Rest desativada para importação de arquivos
 - imp/imp.php: UIL Http/Rest para importação de arquivos

Bll

 - b.php: base
 - bac.php: Controla Configurações
 - bau.php: Controla usuários
 - bb.php: Controla a movimentação 'Contas correntes'
 - bbp.pgp: Contola os pagamentos emitidos e vinculação a movimento bancário
 - bbs.php: Controla os recebimentos que tem origem em 'Contas a receber' e destino em 'Contas correntes'
 - bri: Controla a origem de 'Contas a receber'
 - brm: Controla a movimentação de 'Contas a receber'


 - imp/movimp.php: Recebe arquivo de movimento báncário e os tratuz para bb.php
    - imp/movimpcnab200.php: Complelento de movimp.php para receber movimento cnab200 Bradesco
    - imp/movimpofx.php: Complelento de movimp.php para receber movimento ofx. Não completamente desenvolvida e debigada pois este padrão mostrou uma capacidade de validação abaixo dos Cnabs e do desejável. 

Dal
 - Cada arquivo iniciado em 'd' normalmente possui um ocrrespondente iniciado em 'b' para o acesso a base de dados.

Other notes

public $DbList = array(
  "bcnx" => "Cr.não identificado",
  "bdnx" => "Db.não identificado",
  "bfdx" => "Db.Distribuição lucro",
  "bfex" => "Cr.Aporte de capital",
  "bffu" => "Db.Repagamento",
  "bffx" => "Cr.Captação",
  "bfix" => "Juros financiamento",
  "biau" => "Cr.Rec.vd.imobilizado",
  "biax" => "Db.Pag.imoblizado",
  "bifu" => "Cr.Resgate",
  "bifx" => "Db.Aplicação",
  "biix" => "Juros aplicações",
  "bipu" => "Cr.Estorno Pag.imob.",
  "bopu" => "Cr.Estorno Pag.oper.",
  "bopx" => "Db.Pag.Operacional",
  "boru" => "Db.Estorno Rec.Oper.",
  "borx" => "Cr.Clientes",                  => BanRec
  "man" => "Ajuste manual",
  "paax" => "Req.adiantamento imob.",
  "paox" => "Req.adiantamento oper.",
  "pidx" => "Distribuição Resultado",
  "piix" => "Compra imobilizado",
  "piox" => "Custo ou Desp.oper.",
  "plix" => "Pag.imobilizado",
  "plou" => "Estorno pag.operacional",
  "plox" => "Pag.operacional",
  "rbex" => "Rec.Aporte de capital",
  "rbou" => "Db.Estorno clientes",
  "rbox" => "Rec.clientes",
  "rieu" => "Redução de capital",
  "riex" => "Aporte capital",
  "riox" => "Rec.operac.out",
  "risx" => "Venda serviços",