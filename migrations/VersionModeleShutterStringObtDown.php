<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class VersionModeleShutterStringObtDown extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE modele_shutter');
        $this->addSql('ALTER TABLE modele CHANGE obt shutter VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE modele_shutter (modele_id INT NOT NULL, shutter_id INT NOT NULL, INDEX IDX_81D075277C8FDD42 (shutter_id), INDEX IDX_81D07527AC14B70A (modele_id), PRIMARY KEY(modele_id, shutter_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE modele_shutter ADD CONSTRAINT FK_81D075277C8FDD42 FOREIGN KEY (shutter_id) REFERENCES shutter (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_shutter ADD CONSTRAINT FK_81D07527AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele CHANGE shutter obt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        
    }
}
