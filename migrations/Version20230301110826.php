<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301110826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription ADD justif_financement_nom VARCHAR(255) DEFAULT NULL, ADD carte_vitale_nom VARCHAR(255) DEFAULT NULL, ADD autre_doc_nom VARCHAR(255) DEFAULT NULL, CHANGE filename carte_identite_nom VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription ADD filename VARCHAR(255) DEFAULT NULL, DROP carte_identite_nom, DROP justif_financement_nom, DROP carte_vitale_nom, DROP autre_doc_nom');
    }
}
