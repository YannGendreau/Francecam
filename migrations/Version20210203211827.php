<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203211827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_film (film_source INT NOT NULL, film_target INT NOT NULL, INDEX IDX_E7EB542134784279 (film_source), INDEX IDX_E7EB54212D9D12F6 (film_target), PRIMARY KEY(film_source, film_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_film ADD CONSTRAINT FK_E7EB542134784279 FOREIGN KEY (film_source) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_film ADD CONSTRAINT FK_E7EB54212D9D12F6 FOREIGN KEY (film_target) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE marque_film');
        $this->addSql('ALTER TABLE marque CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE website website VARCHAR(255) DEFAULT NULL, CHANGE creation creation INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marque_film (marque_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_8F6727814827B9B2 (marque_id), INDEX IDX_8F672781567F5183 (film_id), PRIMARY KEY(marque_id, film_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE marque_film ADD CONSTRAINT FK_8F6727814827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marque_film ADD CONSTRAINT FK_8F672781567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE film_film');
        $this->addSql('ALTER TABLE marque CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE website website VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pays pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE creation creation INT NOT NULL');
    }
}
