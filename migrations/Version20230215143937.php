<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215143937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE pre_inscription ADD user_id INT DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(20) DEFAULT NULL, CHANGE prenom prenom VARCHAR(20) DEFAULT NULL, CHANGE date_naissance date_naissance DATE DEFAULT NULL, CHANGE sexe sexe VARCHAR(10) DEFAULT NULL, CHANGE adresse adresse VARCHAR(100) DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE ville ville VARCHAR(50) DEFAULT NULL, CHANGE region region VARCHAR(50) DEFAULT NULL, CHANGE pays pays VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL, CHANGE motivations motivations VARCHAR(255) DEFAULT NULL, CHANGE financement financement VARCHAR(255) DEFAULT NULL, CHANGE carte_identite carte_identite VARCHAR(255) DEFAULT NULL, CHANGE justif_financement justif_financement VARCHAR(255) DEFAULT NULL, CHANGE carte_vitale carte_vitale VARCHAR(255) DEFAULT NULL, CHANGE autre_doc autre_doc VARCHAR(255) DEFAULT NULL, CHANGE n_ss n_ss VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(20) DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_B2AA45A9A76ED395 ON pre_inscription (user_id)');
        $this->addSql('ALTER TABLE role CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE libelle libelle VARCHAR(50) DEFAULT NULL, CHANGE code_role code_role VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP identifiant, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(20) DEFAULT NULL, CHANGE prenom prenom VARCHAR(20) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, object VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, message VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, file VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pre_inscription DROP FOREIGN KEY FK_B2AA45A9A76ED395');
        $this->addSql('DROP INDEX IDX_B2AA45A9A76ED395 ON pre_inscription');
        $this->addSql('ALTER TABLE pre_inscription DROP user_id, CHANGE id id INT NOT NULL, CHANGE nom nom VARCHAR(20) NOT NULL, CHANGE prenom prenom VARCHAR(20) NOT NULL, CHANGE date_naissance date_naissance DATE NOT NULL, CHANGE sexe sexe VARCHAR(10) NOT NULL, CHANGE adresse adresse VARCHAR(100) NOT NULL, CHANGE code_postal code_postal INT NOT NULL, CHANGE ville ville VARCHAR(50) NOT NULL, CHANGE region region VARCHAR(50) NOT NULL, CHANGE pays pays VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE motivations motivations VARCHAR(255) NOT NULL, CHANGE financement financement VARCHAR(255) NOT NULL, CHANGE carte_identite carte_identite VARCHAR(255) NOT NULL, CHANGE justif_financement justif_financement VARCHAR(255) NOT NULL, CHANGE carte_vitale carte_vitale VARCHAR(255) NOT NULL, CHANGE autre_doc autre_doc VARCHAR(255) NOT NULL, CHANGE n_ss n_ss VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE id id INT NOT NULL, CHANGE libelle libelle VARCHAR(50) NOT NULL, CHANGE code_role code_role VARCHAR(50) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD identifiant VARCHAR(50) NOT NULL, CHANGE id id INT NOT NULL, CHANGE password password VARCHAR(20) NOT NULL, CHANGE prenom prenom VARCHAR(20) NOT NULL, CHANGE nom nom VARCHAR(20) NOT NULL');
    }
}
