<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class VersionRefactoDBForCamera extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS `camera` (
            `id` int NOT NULL AUTO_INCREMENT,
            `marque_id` int DEFAULT NULL,
            `modele_id` int DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `IDX_3B1CEE054827B9B2` (`marque_id`),
            KEY `IDX_3B1CEE05AC14B70A` (`modele_id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE camera');
    }
}
