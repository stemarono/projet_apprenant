<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202135239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenant (id INT AUTO_INCREMENT NOT NULL, identifiant VARCHAR(30) NOT NULL, prenom VARCHAR(30) DEFAULT NULL, nom VARCHAR(30) DEFAULT NULL, date_naissance DATETIME DEFAULT NULL, sexe VARCHAR(10) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, region VARCHAR(50) NOT NULL, pays VARCHAR(50) DEFAULT NULL, telephone INT DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, num_secu INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(150) DEFAULT NULL, lastname VARCHAR(150) DEFAULT NULL, email VARCHAR(150) DEFAULT NULL, object VARCHAR(150) DEFAULT NULL, message VARCHAR(150) DEFAULT NULL, file VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cursus (id INT AUTO_INCREMENT NOT NULL, code_cursus VARCHAR(20) NOT NULL, libelle_cursus VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE financement (id INT AUTO_INCREMENT NOT NULL, code_financement VARCHAR(20) NOT NULL, libelle_financement VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, parcours_id INT DEFAULT NULL, code VARCHAR(20) NOT NULL, titre VARCHAR(20) DEFAULT NULL, description VARCHAR(150) DEFAULT NULL, contenu VARCHAR(1000) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, date_formation DATETIME DEFAULT NULL, parcours VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_404021BF6E38C0DB (parcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_cursus (id INT AUTO_INCREMENT NOT NULL, cursus_id INT DEFAULT NULL, code_gpe_cursus VARCHAR(20) NOT NULL, libelle_gpe_cursus VARCHAR(30) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_696B5CF940AEF4B9 (cursus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, groupe_cursus_id INT DEFAULT NULL, mode_paiement_id INT DEFAULT NULL, financement_id INT DEFAULT NULL, parcours_id INT DEFAULT NULL, date_inscription DATETIME NOT NULL, echeance INT NOT NULL, montant NUMERIC(10, 2) NOT NULL, UNIQUE INDEX UNIQ_5E90F6D6103A278E (groupe_cursus_id), UNIQUE INDEX UNIQ_5E90F6D6438F5B63 (mode_paiement_id), UNIQUE INDEX UNIQ_5E90F6D6A737ED74 (financement_id), UNIQUE INDEX UNIQ_5E90F6D66E38C0DB (parcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_paiement (id INT AUTO_INCREMENT NOT NULL, code_mode_paie VARCHAR(20) NOT NULL, libelle_mode_paie VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, code_parcours VARCHAR(20) NOT NULL, libelle_parcours VARCHAR(30) NOT NULL, INDEX IDX_99B1DEE35200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pre_inscription (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, date_naissance DATE DEFAULT NULL, sexe VARCHAR(10) DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, region VARCHAR(50) DEFAULT NULL, pays VARCHAR(50) DEFAULT NULL, telephone INT DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, motivations VARCHAR(255) DEFAULT NULL, financement VARCHAR(255) DEFAULT NULL, carte_identite VARCHAR(255) DEFAULT NULL, justif_financement VARCHAR(255) DEFAULT NULL, carte_vitale VARCHAR(255) DEFAULT NULL, autre_doc VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF6E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE groupe_cursus ADD CONSTRAINT FK_696B5CF940AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6103A278E FOREIGN KEY (groupe_cursus_id) REFERENCES groupe_cursus (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6438F5B63 FOREIGN KEY (mode_paiement_id) REFERENCES mode_paiement (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A737ED74 FOREIGN KEY (financement_id) REFERENCES financement (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D66E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('DROP TABLE form_preinscription');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE form_preinscription (id INT AUTO_INCREMENT NOT NULL, identifiant VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE DEFAULT NULL, sexe VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, code_postal INT DEFAULT NULL, ville VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, region VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, telephone INT DEFAULT NULL, email VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, n_ss VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, motivations VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, financement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, carte_identite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, justif_financement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, carte_vitale VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, autre_doc VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF6E38C0DB');
        $this->addSql('ALTER TABLE groupe_cursus DROP FOREIGN KEY FK_696B5CF940AEF4B9');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6103A278E');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6438F5B63');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A737ED74');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D66E38C0DB');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE35200282E');
        $this->addSql('DROP TABLE apprenant');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE cursus');
        $this->addSql('DROP TABLE financement');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE groupe_cursus');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE mode_paiement');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE pre_inscription');
    }
}
