<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319122955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE modele_shutter (modele_id INT NOT NULL, shutter_id INT NOT NULL, INDEX IDX_81D07527AC14B70A (modele_id), INDEX IDX_81D075277C8FDD42 (shutter_id), PRIMARY KEY(modele_id, shutter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele_mount (modele_id INT NOT NULL, mount_id INT NOT NULL, INDEX IDX_9F25C81CAC14B70A (modele_id), INDEX IDX_9F25C81C538228B8 (mount_id), PRIMARY KEY(modele_id, mount_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modele_shutter ADD CONSTRAINT FK_81D07527AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_shutter ADD CONSTRAINT FK_81D075277C8FDD42 FOREIGN KEY (shutter_id) REFERENCES shutter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_mount ADD CONSTRAINT FK_9F25C81CAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_mount ADD CONSTRAINT FK_9F25C81C538228B8 FOREIGN KEY (mount_id) REFERENCES mount (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_marque ADD CONSTRAINT FK_319DACC4567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_genre ADD CONSTRAINT FK_1A3CCDA8567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_modele ADD CONSTRAINT FK_7BF0B852567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_director ADD CONSTRAINT FK_BC171C99567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_dirphoto ADD CONSTRAINT FK_195568B8567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele DROP shutter, DROP mount');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL, CHANGE is_verified is_verified TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE modele_shutter');
        $this->addSql('DROP TABLE modele_mount');
        $this->addSql('ALTER TABLE film_director DROP FOREIGN KEY FK_BC171C99567F5183');
        $this->addSql('ALTER TABLE film_dirphoto DROP FOREIGN KEY FK_195568B8567F5183');
        $this->addSql('ALTER TABLE film_genre DROP FOREIGN KEY FK_1A3CCDA8567F5183');
        $this->addSql('ALTER TABLE film_marque DROP FOREIGN KEY FK_319DACC4567F5183');
        $this->addSql('ALTER TABLE film_modele DROP FOREIGN KEY FK_7BF0B852567F5183');
        $this->addSql('ALTER TABLE modele ADD shutter VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD mount VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE roles roles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE is_verified is_verified TINYINT(1) NOT NULL');
    }
}
