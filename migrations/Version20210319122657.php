<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210319122657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_camera DROP FOREIGN KEY FK_50EED30FB47685CD');
        $this->addSql('ALTER TABLE cameras_format DROP FOREIGN KEY FK_44829B6121075AD');
        $this->addSql('ALTER TABLE cameras_mount DROP FOREIGN KEY FK_BDB3F28221075AD');
        $this->addSql('ALTER TABLE cameras_shutter DROP FOREIGN KEY FK_A81E299721075AD');
        $this->addSql('ALTER TABLE film_cameras DROP FOREIGN KEY FK_8BE13C4921075AD');
        $this->addSql('CREATE TABLE modele_format (modele_id INT NOT NULL, format_id INT NOT NULL, INDEX IDX_5317B318AC14B70A (modele_id), INDEX IDX_5317B318D629F605 (format_id), PRIMARY KEY(modele_id, format_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modele_format ADD CONSTRAINT FK_5317B318AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_format ADD CONSTRAINT FK_5317B318D629F605 FOREIGN KEY (format_id) REFERENCES format (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE cameras');
        $this->addSql('DROP TABLE cameras_format');
        $this->addSql('DROP TABLE cameras_mount');
        $this->addSql('DROP TABLE cameras_shutter');
        $this->addSql('DROP TABLE film_camera');
        $this->addSql('DROP TABLE film_cameras');
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
        $this->addSql('CREATE TABLE camera (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, modele_id INT DEFAULT NULL, marque_modele VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3B1CEE054827B9B2 (marque_id), INDEX IDX_3B1CEE05AC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cameras (id INT AUTO_INCREMENT NOT NULL, marque_rel_id INT DEFAULT NULL, marque VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, modele VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, noise INT NOT NULL, voltage DOUBLE PRECISION NOT NULL, weight DOUBLE PRECISION NOT NULL, view VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_6B5F276A42F36824 (marque_rel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cameras_format (cameras_id INT NOT NULL, format_id INT NOT NULL, INDEX IDX_44829B6121075AD (cameras_id), INDEX IDX_44829B61D629F605 (format_id), PRIMARY KEY(cameras_id, format_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cameras_mount (cameras_id INT NOT NULL, mount_id INT NOT NULL, INDEX IDX_BDB3F28221075AD (cameras_id), INDEX IDX_BDB3F282538228B8 (mount_id), PRIMARY KEY(cameras_id, mount_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cameras_shutter (cameras_id INT NOT NULL, shutter_id INT NOT NULL, INDEX IDX_A81E299721075AD (cameras_id), INDEX IDX_A81E29977C8FDD42 (shutter_id), PRIMARY KEY(cameras_id, shutter_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE film_camera (film_id INT NOT NULL, camera_id INT NOT NULL, INDEX IDX_50EED30F567F5183 (film_id), INDEX IDX_50EED30FB47685CD (camera_id), PRIMARY KEY(film_id, camera_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE film_cameras (film_id INT NOT NULL, cameras_id INT NOT NULL, INDEX IDX_8BE13C4921075AD (cameras_id), INDEX IDX_8BE13C49567F5183 (film_id), PRIMARY KEY(film_id, cameras_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE054827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE05AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE cameras ADD CONSTRAINT FK_6B5F276A42F36824 FOREIGN KEY (marque_rel_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE cameras_format ADD CONSTRAINT FK_44829B6121075AD FOREIGN KEY (cameras_id) REFERENCES cameras (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_format ADD CONSTRAINT FK_44829B61D629F605 FOREIGN KEY (format_id) REFERENCES format (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_mount ADD CONSTRAINT FK_BDB3F28221075AD FOREIGN KEY (cameras_id) REFERENCES cameras (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_mount ADD CONSTRAINT FK_BDB3F282538228B8 FOREIGN KEY (mount_id) REFERENCES mount (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_shutter ADD CONSTRAINT FK_A81E299721075AD FOREIGN KEY (cameras_id) REFERENCES cameras (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cameras_shutter ADD CONSTRAINT FK_A81E29977C8FDD42 FOREIGN KEY (shutter_id) REFERENCES shutter (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_camera ADD CONSTRAINT FK_50EED30FB47685CD FOREIGN KEY (camera_id) REFERENCES camera (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_cameras ADD CONSTRAINT FK_8BE13C4921075AD FOREIGN KEY (cameras_id) REFERENCES cameras (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE modele_format');
        $this->addSql('ALTER TABLE film_director DROP FOREIGN KEY FK_BC171C99567F5183');
        $this->addSql('ALTER TABLE film_dirphoto DROP FOREIGN KEY FK_195568B8567F5183');
        $this->addSql('ALTER TABLE film_genre DROP FOREIGN KEY FK_1A3CCDA8567F5183');
        $this->addSql('ALTER TABLE film_marque DROP FOREIGN KEY FK_319DACC4567F5183');
        $this->addSql('ALTER TABLE film_modele DROP FOREIGN KEY FK_7BF0B852567F5183');
        $this->addSql('ALTER TABLE modele ADD shutter VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD mount VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE roles roles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE is_verified is_verified TINYINT(1) NOT NULL');
    }
}
