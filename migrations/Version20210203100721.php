<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203100721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marque_film (marque_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_8F6727814827B9B2 (marque_id), INDEX IDX_8F672781567F5183 (film_id), PRIMARY KEY(marque_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marque_film ADD CONSTRAINT FK_8F6727814827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marque_film ADD CONSTRAINT FK_8F672781567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE film_modele');
        $this->addSql('ALTER TABLE film ADD title VARCHAR(255) NOT NULL, ADD decade INT NOT NULL, DROP titre, DROP pays, CHANGE sortie sortie INT NOT NULL');
        $this->addSql('ALTER TABLE marque ADD creation INT NOT NULL, DROP created, CHANGE nom name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_modele (film_id INT NOT NULL, modele_id INT NOT NULL, INDEX IDX_7BF0B852567F5183 (film_id), INDEX IDX_7BF0B852AC14B70A (modele_id), PRIMARY KEY(film_id, modele_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE film_modele ADD CONSTRAINT FK_7BF0B852567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_modele ADD CONSTRAINT FK_7BF0B852AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE marque_film');
        $this->addSql('ALTER TABLE film ADD pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP decade, CHANGE sortie sortie DATE NOT NULL, CHANGE title titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE marque ADD created DATE NOT NULL, DROP creation, CHANGE name nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
