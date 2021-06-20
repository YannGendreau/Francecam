<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version35FilmModeleMarqueDesc500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film CHANGE synopsis synopsis VARCHAR(500) NOT NULL, CHANGE is_verified is_verified TINYINT(1) DEFAULT \'0\'');
        
        $this->addSql('ALTER TABLE marque CHANGE description description VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE modele CHANGE description description VARCHAR(500) NOT NULL');
        
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film CHANGE synopsis synopsis VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE is_verified is_verified TINYINT(1) DEFAULT NULL');
       
        $this->addSql('ALTER TABLE marque CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE modele CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        
    }
}
