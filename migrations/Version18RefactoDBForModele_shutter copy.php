<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version18RefactoDBForModele_shutter extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `modele_shutter` (
            `modele_id` int NOT NULL,
            `shutter_id` int NOT NULL,
            PRIMARY KEY (`modele_id`,`shutter_id`),
            KEY `IDX_81D07527AC14B70A` (`modele_id`),
            KEY `IDX_81D075277C8FDD42` (`shutter_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE modele_shutter');
    }
}
