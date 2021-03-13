<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313144045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cameras_mount (cameras_id INT NOT NULL, mount_id INT NOT NULL, INDEX IDX_BDB3F28221075AD (cameras_id), INDEX IDX_BDB3F282538228B8 (mount_id), PRIMARY KEY(cameras_id, mount_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cameras_mount ADD CONSTRAINT FK_BDB3F28221075AD FOREIGN KEY (cameras_id) REFERENCES cameras (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_mount ADD CONSTRAINT FK_BDB3F282538228B8 FOREIGN KEY (mount_id) REFERENCES mount (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras DROP mount');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cameras_mount');
        $this->addSql('ALTER TABLE cameras ADD mount VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE roles roles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
