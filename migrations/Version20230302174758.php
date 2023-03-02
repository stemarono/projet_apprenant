<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230302174758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, objet VARCHAR(50) DEFAULT NULL, message VARCHAR(255) NOT NULL, fichier VARCHAR(255) DEFAULT NULL, fichiernom VARCHAR(255) DEFAULT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pre_inscription ADD carte_identite_nom VARCHAR(255) DEFAULT NULL, ADD justif_financement_nom VARCHAR(255) DEFAULT NULL, ADD carte_vitale_nom VARCHAR(255) DEFAULT NULL, ADD autre_doc_nom VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE pre_inscription DROP carte_identite_nom, DROP justif_financement_nom, DROP carte_vitale_nom, DROP autre_doc_nom');
    }
}
