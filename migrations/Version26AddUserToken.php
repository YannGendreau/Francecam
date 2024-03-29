<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version26AddUserToken extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE users ADD activation_token VARCHAR(50) DEFAULT NULL, DROP is_verified');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE users ADD is_verified TINYINT(1) NOT NULL, DROP activation_token');
    }
}
