<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213151024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pre_inscription ADD CONSTRAINT FK_B2AA45A9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B2AA45A9A76ED395 ON pre_inscription (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C8121CE9');
        $this->addSql('DROP INDEX UNIQ_8D93D649C8121CE9 ON user');
        $this->addSql('ALTER TABLE user DROP nom_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pre_inscription DROP FOREIGN KEY FK_B2AA45A9A76ED395');
        $this->addSql('DROP INDEX IDX_B2AA45A9A76ED395 ON pre_inscription');
        $this->addSql('ALTER TABLE pre_inscription DROP user_id');
        $this->addSql('ALTER TABLE user ADD nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C8121CE9 FOREIGN KEY (nom_id) REFERENCES pre_inscription (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C8121CE9 ON user (nom_id)');
    }
}
