<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version15RefactoDBForModele extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `modele` (
            `id` int NOT NULL AUTO_INCREMENT,
            `marque_id` int DEFAULT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `noise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `framerate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `perfs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `magazine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `voltage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `view` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `sync` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `decade` int NOT NULL,
            `sortie` int NOT NULL,
            `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            `updated_at` datetime NOT NULL,
            `created_at` datetime NOT NULL,
            `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `IDX_100285584827B9B2` (`marque_id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE modele');
    }
}
