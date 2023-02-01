<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131150942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_cursus ADD cursus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe_cursus ADD CONSTRAINT FK_696B5CF940AEF4B9 FOREIGN KEY (cursus_id) REFERENCES cursus (id)');
        $this->addSql('CREATE INDEX IDX_696B5CF940AEF4B9 ON groupe_cursus (cursus_id)');
        $this->addSql('ALTER TABLE inscription ADD groupe_cursus_id INT DEFAULT NULL, ADD mode_paiement_id INT DEFAULT NULL, ADD financement_id INT DEFAULT NULL, ADD parcours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6103A278E FOREIGN KEY (groupe_cursus_id) REFERENCES groupe_cursus (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6438F5B63 FOREIGN KEY (mode_paiement_id) REFERENCES mode_paiement (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A737ED74 FOREIGN KEY (financement_id) REFERENCES financement (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D66E38C0DB FOREIGN KEY (parcours_id) REFERENCES parcours (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D6103A278E ON inscription (groupe_cursus_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D6438F5B63 ON inscription (mode_paiement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D6A737ED74 ON inscription (financement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D66E38C0DB ON inscription (parcours_id)');
        $this->addSql('ALTER TABLE parcours ADD formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_99B1DEE35200282E ON parcours (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE35200282E');
        $this->addSql('DROP INDEX IDX_99B1DEE35200282E ON parcours');
        $this->addSql('ALTER TABLE parcours DROP formation_id');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6103A278E');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6438F5B63');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A737ED74');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D66E38C0DB');
        $this->addSql('DROP INDEX UNIQ_5E90F6D6103A278E ON inscription');
        $this->addSql('DROP INDEX UNIQ_5E90F6D6438F5B63 ON inscription');
        $this->addSql('DROP INDEX UNIQ_5E90F6D6A737ED74 ON inscription');
        $this->addSql('DROP INDEX UNIQ_5E90F6D66E38C0DB ON inscription');
        $this->addSql('ALTER TABLE inscription DROP groupe_cursus_id, DROP mode_paiement_id, DROP financement_id, DROP parcours_id');
        $this->addSql('ALTER TABLE groupe_cursus DROP FOREIGN KEY FK_696B5CF940AEF4B9');
        $this->addSql('DROP INDEX IDX_696B5CF940AEF4B9 ON groupe_cursus');
        $this->addSql('ALTER TABLE groupe_cursus DROP cursus_id');
    }
}
