<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210118161912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, duree INT NOT NULL, sortie DATE NOT NULL, synopsis VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_marque (film_id INT NOT NULL, marque_id INT NOT NULL, INDEX IDX_319DACC4567F5183 (film_id), INDEX IDX_319DACC44827B9B2 (marque_id), PRIMARY KEY(film_id, marque_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gamme (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C32E14684827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, gamme_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, noise VARCHAR(255) NOT NULL, shutter VARCHAR(255) NOT NULL, mount VARCHAR(255) NOT NULL, framerate VARCHAR(255) NOT NULL, perfs VARCHAR(255) NOT NULL, magazine VARCHAR(255) NOT NULL, voltage VARCHAR(255) NOT NULL, weight VARCHAR(255) NOT NULL, view VARCHAR(255) NOT NULL, sync VARCHAR(255) NOT NULL, INDEX IDX_10028558D2FD85F1 (gamme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC4567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC44827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E14684827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558D2FD85F1 FOREIGN KEY (gamme_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE marque ADD website VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_marque DROP FOREIGN KEY FK_319DACC4567F5183');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558D2FD85F1');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE film_marque');
        $this->addSql('DROP TABLE gamme');
        $this->addSql('DROP TABLE modele');
        $this->addSql('ALTER TABLE marque DROP website');
    }
}
