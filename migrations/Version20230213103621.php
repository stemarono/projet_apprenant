<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213103621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) DEFAULT NULL, code_role VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prenom VARCHAR(20) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649C8121CE9 (nom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C8121CE9 FOREIGN KEY (nom_id) REFERENCES pre_inscription (id)');
        $this->addSql('DROP TABLE pre_inscriptions');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE groupe_cursus ADD CONSTRAINT FK_696B5CF940AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE8436103A278E FOREIGN KEY (groupe_cursus_id) REFERENCES groupe_cursus (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE843640AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE84366E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE8436A737ED74 FOREIGN KEY (financement_id) REFERENCES financement (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE8436438F5B63 FOREIGN KEY (mode_paiement_id) REFERENCES mode_paiement (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pre_inscriptions (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE DEFAULT NULL, sexe VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, code_postal INT DEFAULT NULL, ville VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, region VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, motivations VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, financement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, carte_identite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, justif_financement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, carte_vitale VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, autre_doc VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, n_ss VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C8121CE9');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF6E38C0DB');
        $this->addSql('ALTER TABLE groupe_cursus DROP FOREIGN KEY FK_696B5CF940AEF4B9');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE8436103A278E');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE843640AEF4B9');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE84366E38C0DB');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE8436A737ED74');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE8436438F5B63');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE35200282E');
    }
}
