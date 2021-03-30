<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version01RefactoDBForFilm_dirphoto extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `film_dirphoto` (
            `film_id` int NOT NULL,
            `dirphoto_id` int NOT NULL,
            PRIMARY KEY (`film_id`,`dirphoto_id`),
            KEY `IDX_195568B8567F5183` (`film_id`),
            KEY `IDX_195568B86391035A` (`dirphoto_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE film_dirphoto');
    }
}
