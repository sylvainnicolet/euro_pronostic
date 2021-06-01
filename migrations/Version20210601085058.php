<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601085058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composition ADD team_2_id INT NOT NULL');
        $this->addSql('ALTER TABLE composition ADD team_3_id INT NOT NULL');
        $this->addSql('ALTER TABLE composition ADD team_4_id INT NOT NULL');
        $this->addSql('ALTER TABLE composition ADD team_5_id INT NOT NULL');
        $this->addSql('ALTER TABLE composition ADD team_6_id INT NOT NULL');
        $this->addSql('ALTER TABLE composition ADD team_7_id INT NOT NULL');
        $this->addSql('ALTER TABLE composition ADD team_8_id INT NOT NULL');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43473387076F FOREIGN KEY (team_2_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43478B3B600A FOREIGN KEY (team_3_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F434716EC58B3 FOREIGN KEY (team_4_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347AE503FD6 FOREIGN KEY (team_5_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347BCE59038 FOREIGN KEY (team_6_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347459F75D FOREIGN KEY (team_7_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43475C3AE70B FOREIGN KEY (team_8_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C7F43473387076F ON composition (team_2_id)');
        $this->addSql('CREATE INDEX IDX_C7F43478B3B600A ON composition (team_3_id)');
        $this->addSql('CREATE INDEX IDX_C7F434716EC58B3 ON composition (team_4_id)');
        $this->addSql('CREATE INDEX IDX_C7F4347AE503FD6 ON composition (team_5_id)');
        $this->addSql('CREATE INDEX IDX_C7F4347BCE59038 ON composition (team_6_id)');
        $this->addSql('CREATE INDEX IDX_C7F4347459F75D ON composition (team_7_id)');
        $this->addSql('CREATE INDEX IDX_C7F43475C3AE70B ON composition (team_8_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F43473387076F');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F43478B3B600A');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F434716EC58B3');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F4347AE503FD6');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F4347BCE59038');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F4347459F75D');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F43475C3AE70B');
        $this->addSql('DROP INDEX IDX_C7F43473387076F');
        $this->addSql('DROP INDEX IDX_C7F43478B3B600A');
        $this->addSql('DROP INDEX IDX_C7F434716EC58B3');
        $this->addSql('DROP INDEX IDX_C7F4347AE503FD6');
        $this->addSql('DROP INDEX IDX_C7F4347BCE59038');
        $this->addSql('DROP INDEX IDX_C7F4347459F75D');
        $this->addSql('DROP INDEX IDX_C7F43475C3AE70B');
        $this->addSql('ALTER TABLE composition DROP team_2_id');
        $this->addSql('ALTER TABLE composition DROP team_3_id');
        $this->addSql('ALTER TABLE composition DROP team_4_id');
        $this->addSql('ALTER TABLE composition DROP team_5_id');
        $this->addSql('ALTER TABLE composition DROP team_6_id');
        $this->addSql('ALTER TABLE composition DROP team_7_id');
        $this->addSql('ALTER TABLE composition DROP team_8_id');
    }
}
