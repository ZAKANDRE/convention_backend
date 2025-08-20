<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250819145910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention ADD CONSTRAINT FK_8556657EE6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('CREATE INDEX IDX_8556657EE6389D24 ON convention (society_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention DROP FOREIGN KEY FK_8556657EE6389D24');
        $this->addSql('DROP INDEX IDX_8556657EE6389D24 ON convention');
    }
}
