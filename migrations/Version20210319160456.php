<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319160456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE FULLTEXT INDEX IDX_8244BE222B36786B ON film (title)');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC4567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_genre ADD CONSTRAINT FK_1A3CCDA8567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_modele ADD CONSTRAINT FK_7BF0B852567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_director ADD CONSTRAINT FK_BC171C99567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_dirphoto ADD CONSTRAINT FK_195568B8567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele DROP shutter, DROP mount, CHANGE marque_id marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL, CHANGE is_verified is_verified TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_8244BE222B36786B ON film');
        $this->addSql('ALTER TABLE film_director DROP FOREIGN KEY FK_BC171C99567F5183');
        $this->addSql('ALTER TABLE film_dirphoto DROP FOREIGN KEY FK_195568B8567F5183');
        $this->addSql('ALTER TABLE film_genre DROP FOREIGN KEY FK_1A3CCDA8567F5183');
        $this->addSql('ALTER TABLE film_marque DROP FOREIGN KEY FK_319DACC4567F5183');
        $this->addSql('ALTER TABLE film_modele DROP FOREIGN KEY FK_7BF0B852567F5183');
        $this->addSql('ALTER TABLE modele ADD shutter VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD mount VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE marque_id marque_id INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE roles roles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE is_verified is_verified TINYINT(1) NOT NULL');
    }
}
