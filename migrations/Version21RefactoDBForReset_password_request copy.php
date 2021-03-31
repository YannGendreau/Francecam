<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version21RefactoDBForReset_password_request extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE `reset_password_request` (
            `id` int NOT NULL AUTO_INCREMENT,
            `user_id` int NOT NULL,
            `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
            `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            PRIMARY KEY (`id`),
            KEY `IDX_7CE748AA76ED395` (`user_id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password_request');
    }
}
