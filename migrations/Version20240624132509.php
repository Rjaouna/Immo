<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624132509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien_immo DROP FOREIGN KEY FK_174DAB719EB6921');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP INDEX IDX_174DAB719EB6921 ON bien_immo');
        $this->addSql('ALTER TABLE bien_immo DROP client_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FC18272');
        $this->addSql('DROP INDEX UNIQ_B6BD307FC18272 ON message');
        $this->addSql('ALTER TABLE message ADD projet VARCHAR(255) NOT NULL, DROP projet_id, CHANGE name nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE bien_immo ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien_immo ADD CONSTRAINT FK_174DAB719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_174DAB719EB6921 ON bien_immo (client_id)');
        $this->addSql('ALTER TABLE message ADD projet_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, DROP nom, DROP projet');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FC18272 FOREIGN KEY (projet_id) REFERENCES bien_immo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6BD307FC18272 ON message (projet_id)');
    }
}
