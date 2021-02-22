<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222162457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cameras ADD marque_rel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cameras ADD CONSTRAINT FK_6B5F276A42F36824 FOREIGN KEY (marque_rel_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_6B5F276A42F36824 ON cameras (marque_rel_id)');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cameras DROP FOREIGN KEY FK_6B5F276A42F36824');
        $this->addSql('DROP INDEX IDX_6B5F276A42F36824 ON cameras');
        $this->addSql('ALTER TABLE cameras DROP marque_rel_id');
        $this->addSql('ALTER TABLE users CHANGE roles roles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
