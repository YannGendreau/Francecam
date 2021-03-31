<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version25RefactoDBForPK30032021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `film` ADD FULLTEXT KEY `IDX_8244BE222B36786B` (`title`);');
        $this->addSql('ALTER TABLE `marque` ADD FULLTEXT KEY `IDX_5A6F91CE5E237E06` (`name`);');
        $this->addSql('ALTER TABLE `modele` ADD FULLTEXT KEY `IDX_100285585E237E06` (`name`);');
        $this->addSql('ALTER TABLE `camera`
            ADD CONSTRAINT `FK_3B1CEE054827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
            ADD CONSTRAINT `FK_3B1CEE05AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`);');
        $this->addSql('ALTER TABLE `film`
        ADD CONSTRAINT `FK_8244BE22A76ED395` FOREI  GN KEY (`user_id`) REFERENCES `users` (`id`);');
        $this->addSql('ALTER TABLE `film_camera`
            ADD CONSTRAINT `FK_50EED30F567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `FK_50EED30FB47685CD` FOREIGN KEY (`camera_id`) REFERENCES `camera` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_director`
            ADD CONSTRAINT `FK_BC171C99899FB366` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_dirphoto`
            ADD CONSTRAINT `FK_195568B86391035A` FOREIGN KEY (`dirphoto_id`) REFERENCES `dirphoto` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_genre`
            ADD CONSTRAINT `FK_1A3CCDA84296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_marque`
            ADD CONSTRAINT `FK_319DACC44827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_modele`
            ADD CONSTRAINT `FK_7BF0B852AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_pays`
            ADD CONSTRAINT `FK_5130D6AD567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `FK_5130D6ADA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_pays`
            ADD CONSTRAINT `FK_5130D6AD567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `FK_5130D6ADA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele`
            ADD CONSTRAINT `FK_100285584827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`);');
        $this->addSql('ALTER TABLE `modele_format`
            ADD CONSTRAINT `FK_5317B318AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `FK_5317B318D629F605` FOREIGN KEY (`format_id`) REFERENCES `format` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele_mount`
            ADD CONSTRAINT `FK_9F25C81C538228B8` FOREIGN KEY (`mount_id`) REFERENCES `mount` (`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `FK_9F25C81CAC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele_shutter`
            ADD CONSTRAINT `FK_81D075277C8FDD42` FOREIGN KEY (`shutter_id`) REFERENCES `shutter` (`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `FK_81D07527AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele_type`
            ADD CONSTRAINT `FK_4A59230EAC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE,
            ADD CONSTRAINT `FK_4A59230EC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `reset_password_request`
            ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
        COMMIT;');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE `film` DROP FULLTEXT KEY `IDX_8244BE222B36786B` (`title`);');
        $this->addSql('ALTER TABLE `marque` DROP FULLTEXT KEY `IDX_5A6F91CE5E237E06` (`name`);');
        $this->addSql('ALTER TABLE `modele` DROP FULLTEXT KEY `IDX_100285585E237E06` (`name`);');
        $this->addSql('ALTER TABLE `camera`
            DROP CONSTRAINT `FK_3B1CEE054827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
            DROP CONSTRAINT `FK_3B1CEE05AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`);');
        $this->addSql('ALTER TABLE `film`
        DROP CONSTRAINT `FK_8244BE22A76ED395` FOREI  GN KEY (`user_id`) REFERENCES `users` (`id`);');
        $this->addSql('ALTER TABLE `film_camera`
            DROP CONSTRAINT `FK_50EED30F567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
            DROP CONSTRAINT `FK_50EED30FB47685CD` FOREIGN KEY (`camera_id`) REFERENCES `camera` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_director`
            DROP CONSTRAINT `FK_BC171C99899FB366` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_dirphoto`
            DROP CONSTRAINT `FK_195568B86391035A` FOREIGN KEY (`dirphoto_id`) REFERENCES `dirphoto` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_genre`
            DROP CONSTRAINT `FK_1A3CCDA84296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_marque`
            DROP CONSTRAINT `FK_319DACC44827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_modele`
            DROP CONSTRAINT `FK_7BF0B852AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_pays`
            DROP CONSTRAINT `FK_5130D6AD567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
            DROP CONSTRAINT `FK_5130D6ADA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `film_pays`
            DROP CONSTRAINT `FK_5130D6AD567F5183` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE,
            DROP CONSTRAINT `FK_5130D6ADA6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele`
            DROP CONSTRAINT `FK_100285584827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`);');
        $this->addSql('ALTER TABLE `modele_format`
            DROP CONSTRAINT `FK_5317B318AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE,
            DROP CONSTRAINT `FK_5317B318D629F605` FOREIGN KEY (`format_id`) REFERENCES `format` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele_mount`
            DROP CONSTRAINT `FK_9F25C81C538228B8` FOREIGN KEY (`mount_id`) REFERENCES `mount` (`id`) ON DELETE CASCADE,
            DROP CONSTRAINT `FK_9F25C81CAC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele_shutter`
            DROP CONSTRAINT `FK_81D075277C8FDD42` FOREIGN KEY (`shutter_id`) REFERENCES `shutter` (`id`) ON DELETE CASCADE,
            DROP CONSTRAINT `FK_81D07527AC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `modele_type`
            DROP CONSTRAINT `FK_4A59230EAC14B70A` FOREIGN KEY (`modele_id`) REFERENCES `modele` (`id`) ON DELETE CASCADE,
            DROP CONSTRAINT `FK_4A59230EC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE;');
        $this->addSql('ALTER TABLE `reset_password_request`
            DROP CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
        COMMIT;');
    }
}
