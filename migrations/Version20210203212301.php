<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203212301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_marque (film_id INT NOT NULL, marque_id INT NOT NULL, INDEX IDX_319DACC4567F5183 (film_id), INDEX IDX_319DACC44827B9B2 (marque_id), PRIMARY KEY(film_id, marque_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC4567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC44827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE film_film');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_film (film_source INT NOT NULL, film_target INT NOT NULL, INDEX IDX_E7EB54212D9D12F6 (film_target), INDEX IDX_E7EB542134784279 (film_source), PRIMARY KEY(film_source, film_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE film_film ADD CONSTRAINT FK_E7EB54212D9D12F6 FOREIGN KEY (film_target) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_film ADD CONSTRAINT FK_E7EB542134784279 FOREIGN KEY (film_source) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE film_marque');
    }
}
