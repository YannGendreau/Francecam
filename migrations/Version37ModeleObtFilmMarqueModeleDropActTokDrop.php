<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version37ModeleObtFilmMarqueModeleDropActTokDrop extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE film_marque');
        $this->addSql('DROP TABLE film_modele');
        $this->addSql('ALTER TABLE film DROP activation_token');
        $this->addSql('ALTER TABLE modele ADD obt VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(1000) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_marque (film_id INT NOT NULL, marque_id INT NOT NULL, INDEX IDX_319DACC44827B9B2 (marque_id), INDEX IDX_319DACC4567F5183 (film_id), PRIMARY KEY(film_id, marque_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE film_modele (film_id INT NOT NULL, modele_id INT NOT NULL, INDEX IDX_7BF0B852567F5183 (film_id), INDEX IDX_7BF0B852AC14B70A (modele_id), PRIMARY KEY(film_id, modele_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC44827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_modele ADD CONSTRAINT FK_7BF0B852AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film ADD activation_token VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE modele DROP obt, CHANGE description description VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        
    }
}
