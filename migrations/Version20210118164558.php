<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210118164558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_modele (film_id INT NOT NULL, modele_id INT NOT NULL, INDEX IDX_7BF0B852567F5183 (film_id), INDEX IDX_7BF0B852AC14B70A (modele_id), PRIMARY KEY(film_id, modele_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_modele ADD CONSTRAINT FK_7BF0B852567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_modele ADD CONSTRAINT FK_7BF0B852AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE film_marque');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_marque (film_id INT NOT NULL, marque_id INT NOT NULL, INDEX IDX_319DACC44827B9B2 (marque_id), INDEX IDX_319DACC4567F5183 (film_id), PRIMARY KEY(film_id, marque_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC44827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC4567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE film_modele');
    }
}
