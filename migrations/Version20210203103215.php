<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203103215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gamme CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558D2FD85F1');
        $this->addSql('DROP INDEX IDX_10028558D2FD85F1 ON modele');
        $this->addSql('ALTER TABLE modele DROP gamme_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gamme CHANGE name nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE modele ADD gamme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558D2FD85F1 FOREIGN KEY (gamme_id) REFERENCES gamme (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_10028558D2FD85F1 ON modele (gamme_id)');
    }
}
