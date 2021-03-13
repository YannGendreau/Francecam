<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210312160706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cameras_format (cameras_id INT NOT NULL, format_id INT NOT NULL, INDEX IDX_44829B6121075AD (cameras_id), INDEX IDX_44829B61D629F605 (format_id), PRIMARY KEY(cameras_id, format_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cameras_shutter (cameras_id INT NOT NULL, shutter_id INT NOT NULL, INDEX IDX_A81E299721075AD (cameras_id), INDEX IDX_A81E29977C8FDD42 (shutter_id), PRIMARY KEY(cameras_id, shutter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cameras_format ADD CONSTRAINT FK_44829B6121075AD FOREIGN KEY (cameras_id) REFERENCES cameras (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_format ADD CONSTRAINT FK_44829B61D629F605 FOREIGN KEY (format_id) REFERENCES format (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_shutter ADD CONSTRAINT FK_A81E299721075AD FOREIGN KEY (cameras_id) REFERENCES cameras (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_shutter ADD CONSTRAINT FK_A81E29977C8FDD42 FOREIGN KEY (shutter_id) REFERENCES shutter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cameras_format');
        $this->addSql('DROP TABLE cameras_shutter');
        $this->addSql('ALTER TABLE users CHANGE roles roles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
