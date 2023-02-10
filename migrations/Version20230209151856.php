<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209151856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pre_inscription (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) DEFAULT NULL, prenom VARCHAR(20) DEFAULT NULL, date_naissance DATE DEFAULT NULL, sexe VARCHAR(10) DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, region VARCHAR(50) DEFAULT NULL, pays VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, motivations VARCHAR(255) DEFAULT NULL, financement VARCHAR(255) DEFAULT NULL, carte_identite VARCHAR(255) DEFAULT NULL, justif_financement VARCHAR(255) DEFAULT NULL, carte_vitale VARCHAR(255) DEFAULT NULL, autre_doc VARCHAR(255) DEFAULT NULL, n_ss VARCHAR(255) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE user ADD nom_id INT NOT NULL, ADD is_verified TINYINT(1) NOT NULL, DROP nom');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C8121CE9 FOREIGN KEY (nom_id) REFERENCES pre_inscription (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C8121CE9 ON user (nom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649C8121CE9');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, object VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, message VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, file VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE pre_inscription');
        $this->addSql('DROP INDEX UNIQ_8D93D649C8121CE9 ON `user`');
        $this->addSql('ALTER TABLE `user` ADD nom VARCHAR(20) DEFAULT NULL, DROP nom_id, DROP is_verified');
    }
}
