<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210429104707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE move DROP FOREIGN KEY FK_EF3E3778232B318C');
        $this->addSql('DROP INDEX fk_ef3e3778232b318c ON move');
        $this->addSql('CREATE INDEX game ON move (game)');
        $this->addSql('ALTER TABLE move ADD CONSTRAINT FK_EF3E3778232B318C FOREIGN KEY (game) REFERENCES game (id)');
        $this->addSql('ALTER TABLE pieces DROP FOREIGN KEY FK_B92D7472232B318C');
        $this->addSql('ALTER TABLE pieces ADD quit INT DEFAULT NULL');
        $this->addSql('DROP INDEX fk_b92d7472232b318c ON pieces');
        $this->addSql('CREATE INDEX game ON pieces (game)');
        $this->addSql('ALTER TABLE pieces ADD CONSTRAINT FK_B92D7472232B318C FOREIGN KEY (game) REFERENCES game (id)');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65232B318C');
        $this->addSql('DROP INDEX fk_98197a65232b318c ON player');
        $this->addSql('CREATE INDEX game ON player (game)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65232B318C FOREIGN KEY (game) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE move DROP FOREIGN KEY FK_EF3E3778232B318C');
        $this->addSql('DROP INDEX game ON move');
        $this->addSql('CREATE INDEX FK_EF3E3778232B318C ON move (game)');
        $this->addSql('ALTER TABLE move ADD CONSTRAINT FK_EF3E3778232B318C FOREIGN KEY (game) REFERENCES game (id)');
        $this->addSql('ALTER TABLE pieces DROP FOREIGN KEY FK_B92D7472232B318C');
        $this->addSql('ALTER TABLE pieces DROP quit');
        $this->addSql('DROP INDEX game ON pieces');
        $this->addSql('CREATE INDEX FK_B92D7472232B318C ON pieces (game)');
        $this->addSql('ALTER TABLE pieces ADD CONSTRAINT FK_B92D7472232B318C FOREIGN KEY (game) REFERENCES game (id)');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65232B318C');
        $this->addSql('DROP INDEX game ON player');
        $this->addSql('CREATE INDEX FK_98197A65232B318C ON player (game)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65232B318C FOREIGN KEY (game) REFERENCES game (id)');
    }
}
