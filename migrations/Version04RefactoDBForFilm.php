<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version04RefactoDBForFilm extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS `film` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int DEFAULT NULL,
            `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `duree` int NOT NULL,
            `synopsis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `decade` int NOT NULL,
            `sortie` int NOT NULL,
            `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `poster` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `updated_at` datetime NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`),
            KEY `IDX_8244BE22A76ED395` (`user_id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE film');
    }
}
