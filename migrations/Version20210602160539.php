<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602160539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE composition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE composition (id INT NOT NULL, player_id INT NOT NULL, team_1_id INT NOT NULL, team_2_id INT NOT NULL, team_3_id INT NOT NULL, team_4_id INT NOT NULL, team_5_id INT NOT NULL, team_6_id INT NOT NULL, team_7_id INT NOT NULL, team_8_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7F434799E6F5DF ON composition (player_id)');
        $this->addSql('CREATE INDEX IDX_C7F43472132A881 ON composition (team_1_id)');
        $this->addSql('CREATE INDEX IDX_C7F43473387076F ON composition (team_2_id)');
        $this->addSql('CREATE INDEX IDX_C7F43478B3B600A ON composition (team_3_id)');
        $this->addSql('CREATE INDEX IDX_C7F434716EC58B3 ON composition (team_4_id)');
        $this->addSql('CREATE INDEX IDX_C7F4347AE503FD6 ON composition (team_5_id)');
        $this->addSql('CREATE INDEX IDX_C7F4347BCE59038 ON composition (team_6_id)');
        $this->addSql('CREATE INDEX IDX_C7F4347459F75D ON composition (team_7_id)');
        $this->addSql('CREATE INDEX IDX_C7F43475C3AE70B ON composition (team_8_id)');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, team_1_id INT DEFAULT NULL, team_2_id INT DEFAULT NULL, score_1 INT DEFAULT NULL, score_2 INT DEFAULT NULL, is_group_game BOOLEAN NOT NULL, is_finished BOOLEAN NOT NULL, date DATE NOT NULL, time TIME(0) WITHOUT TIME ZONE NOT NULL, phase VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C2132A881 ON game (team_1_id)');
        $this->addSql('CREATE INDEX IDX_232B318C3387076F ON game (team_2_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, name VARCHAR(255) NOT NULL, groupe INT NOT NULL, flag VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F434799E6F5DF FOREIGN KEY (player_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43472132A881 FOREIGN KEY (team_1_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43473387076F FOREIGN KEY (team_2_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43478B3B600A FOREIGN KEY (team_3_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F434716EC58B3 FOREIGN KEY (team_4_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347AE503FD6 FOREIGN KEY (team_5_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347BCE59038 FOREIGN KEY (team_6_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F4347459F75D FOREIGN KEY (team_7_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composition ADD CONSTRAINT FK_C7F43475C3AE70B FOREIGN KEY (team_8_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C2132A881 FOREIGN KEY (team_1_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3387076F FOREIGN KEY (team_2_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F43472132A881');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F43473387076F');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F43478B3B600A');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F434716EC58B3');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F4347AE503FD6');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F4347BCE59038');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F4347459F75D');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F43475C3AE70B');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C2132A881');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C3387076F');
        $this->addSql('ALTER TABLE composition DROP CONSTRAINT FK_C7F434799E6F5DF');
        $this->addSql('DROP SEQUENCE composition_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE composition');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE "user"');
    }
}
