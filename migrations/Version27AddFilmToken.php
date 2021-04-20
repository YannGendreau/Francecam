<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:migrations/Version27AddFilmToken.php
final class Version27AddFilmToken extends AbstractMigration
=======
final class Version26AddUserToken extends AbstractMigration
>>>>>>> afe3f1abf8a805abfff343739dd896b6527631ed:migrations/Version26AddUserToken.php
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
<<<<<<< HEAD:migrations/Version27AddFilmToken.php
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD activation_token VARCHAR(50) DEFAULT NULL');
       
=======
        
>>>>>>> afe3f1abf8a805abfff343739dd896b6527631ed:migrations/Version26AddUserToken.php
    }

    public function down(Schema $schema) : void
    {
<<<<<<< HEAD:migrations/Version27AddFilmToken.php
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP activation_token');
       
=======
        
>>>>>>> afe3f1abf8a805abfff343739dd896b6527631ed:migrations/Version26AddUserToken.php
    }
}
