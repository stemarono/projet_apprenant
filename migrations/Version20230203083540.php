<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203083540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription_apprenant (id INT AUTO_INCREMENT NOT NULL, groupe_cursus_id INT DEFAULT NULL, cursus_id INT DEFAULT NULL, parcours_id INT DEFAULT NULL, financement_id INT DEFAULT NULL, mode_paiement_id INT DEFAULT NULL, identifiant VARCHAR(20) NOT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, date_naissance DATE DEFAULT NULL, sexe VARCHAR(20) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, region VARCHAR(50) DEFAULT NULL, pays VARCHAR(50) DEFAULT NULL, telephone INT DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, num_secu INT DEFAULT NULL, INDEX IDX_62FE8436103A278E (groupe_cursus_id), INDEX IDX_62FE843640AEF4B9 (cursus_id), INDEX IDX_62FE84366E38C0DB (parcours_id), INDEX IDX_62FE8436A737ED74 (financement_id), INDEX IDX_62FE8436438F5B63 (mode_paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE8436103A278E FOREIGN KEY (groupe_cursus_id) REFERENCES groupe_cursus (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE843640AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE84366E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE8436A737ED74 FOREIGN KEY (financement_id) REFERENCES financement (id)');
        $this->addSql('ALTER TABLE inscription_apprenant ADD CONSTRAINT FK_62FE8436438F5B63 FOREIGN KEY (mode_paiement_id) REFERENCES mode_paiement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE8436103A278E');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE843640AEF4B9');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE84366E38C0DB');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE8436A737ED74');
        $this->addSql('ALTER TABLE inscription_apprenant DROP FOREIGN KEY FK_62FE8436438F5B63');
        $this->addSql('DROP TABLE inscription_apprenant');
    }
}
