#!/bin/bash

sudo pear channel-discover pear.phing.info;
sudo pear channel-discover pear.pdepend.org;
sudo pear channel-discover pear.phpmd.org;
sudo pear channel-discover pear.phpunit.de;
sudo pear channel-discover components.ez.no;
sudo pear channel-discover pear.symfony-project.com;

sudo pear install phing/phing;
sudo pear install -a phpmd/PHP_PMD;
sudo pear install phpunit/phpcpd;
sudo pear install phpunit/phploc;
sudo pear install PHPDocumentor;
sudo pear install PHP_CodeSniffer;
sudo pear install HTTP_Request2;
sudo pear install -a phpunit/PHP_CodeBrowser;