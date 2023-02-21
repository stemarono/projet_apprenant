<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220210024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, rang VARCHAR(10) DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, route VARCHAR(255) DEFAULT NULL, INDEX IDX_7D053A93D60322AC (role_id), INDEX IDX_7D053A93727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93727ACA70 FOREIGN KEY (parent_id) REFERENCES menu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93D60322AC');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93727ACA70');
        $this->addSql('DROP TABLE menu');
    }
}
