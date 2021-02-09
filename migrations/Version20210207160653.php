<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210207160653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camera ADD modele_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE05AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_3B1CEE05AC14B70A ON camera (modele_id)');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558B47685CD');
        $this->addSql('DROP INDEX IDX_10028558B47685CD ON modele');
        $this->addSql('ALTER TABLE modele DROP camera_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camera DROP FOREIGN KEY FK_3B1CEE05AC14B70A');
        $this->addSql('DROP INDEX IDX_3B1CEE05AC14B70A ON camera');
        $this->addSql('ALTER TABLE camera DROP modele_id');
        $this->addSql('ALTER TABLE modele ADD camera_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558B47685CD FOREIGN KEY (camera_id) REFERENCES camera (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_10028558B47685CD ON modele (camera_id)');
    }
}
