<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version08RefactoDBForFilm_genre extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `film_genre` (
            `film_id` int NOT NULL,
            `genre_id` int NOT NULL,
            PRIMARY KEY (`film_id`,`genre_id`),
            KEY `IDX_1A3CCDA8567F5183` (`film_id`),
            KEY `IDX_1A3CCDA84296D31F` (`genre_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
          ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE film_genre');
    }
}
