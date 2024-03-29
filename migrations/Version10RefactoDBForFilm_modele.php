<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version10RefactoDBForFilm_modele extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `film_modele` (
            `film_id` int NOT NULL,
            `modele_id` int NOT NULL,
            PRIMARY KEY (`film_id`,`modele_id`),
            KEY `IDX_7BF0B852567F5183` (`film_id`),
            KEY `IDX_7BF0B852AC14B70A` (`modele_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE film_modele');
    }
}
