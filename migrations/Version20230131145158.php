<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131145158 extends AbstractMigration
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
        $this->addSql('CREATE TABLE groupe_cursus (id INT AUTO_INCREMENT NOT NULL, code_gpe_cursus VARCHAR(20) NOT NULL, libelle_gpe_cursus VARCHAR(30) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, date_inscription DATETIME NOT NULL, echeance INT NOT NULL, montant NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_paiement (id INT AUTO_INCREMENT NOT NULL, code_mode_paie VARCHAR(20) NOT NULL, libelle_mode_paie VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, code_parcours VARCHAR(20) NOT NULL, libelle_parcours VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apprenant');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE cursus');
        $this->addSql('DROP TABLE financement');
        $this->addSql('DROP TABLE groupe_cursus');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE mode_paiement');
        $this->addSql('DROP TABLE parcours');
    }
}
