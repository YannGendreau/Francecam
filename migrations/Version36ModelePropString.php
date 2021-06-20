<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version36ModelePropString extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
       
        $this->addSql('ALTER TABLE modele CHANGE framerate framerate VARCHAR(50) DEFAULT NULL, CHANGE perfs perfs VARCHAR(50) DEFAULT NULL, CHANGE voltage voltage VARCHAR(50) DEFAULT NULL, CHANGE weight weight VARCHAR(10) DEFAULT NULL, CHANGE sync sync VARCHAR(100) DEFAULT NULL');
      
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    
        $this->addSql('ALTER TABLE modele CHANGE framerate framerate VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE perfs perfs VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE voltage voltage INT DEFAULT NULL, CHANGE weight weight INT DEFAULT NULL, CHANGE sync sync VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        
    }
}
