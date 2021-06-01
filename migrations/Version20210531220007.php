<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531220007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE composition (id INT NOT NULL, player_id INT NOT NULL, team_1_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7F434799E6F5DF ON composition (player_id)');
        $this->addSql('CREATE INDEX IDX_C7F43472132A881 ON composition (team_1_id)');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F434799E6F5DF FOREIGN KEY (player_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43472132A881 FOREIGN KEY (team_1_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE composition');
    }
}
