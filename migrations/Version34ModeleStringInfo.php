<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version34ModeleStringInfo extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
      
        $this->addSql('ALTER TABLE modele CHANGE framerate framerate VARCHAR(255) DEFAULT NULL, CHANGE perfs perfs VARCHAR(255) DEFAULT NULL, CHANGE magazine magazine VARCHAR(255) DEFAULT NULL');
       
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
       
      
        $this->addSql('ALTER TABLE modele CHANGE framerate framerate INT DEFAULT NULL, CHANGE perfs perfs INT DEFAULT NULL, CHANGE magazine magazine INT DEFAULT NULL');
       
    }
}
