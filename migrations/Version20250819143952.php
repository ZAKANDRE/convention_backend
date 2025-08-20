<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250819143952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE convention_user (convention_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B469C1C1A2ACEBCC (convention_id), INDEX IDX_B469C1C1A76ED395 (user_id), PRIMARY KEY(convention_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convention_user ADD CONSTRAINT FK_B469C1C1A2ACEBCC FOREIGN KEY (convention_id) REFERENCES convention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE convention_user ADD CONSTRAINT FK_B469C1C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention_user DROP FOREIGN KEY FK_B469C1C1A2ACEBCC');
        $this->addSql('ALTER TABLE convention_user DROP FOREIGN KEY FK_B469C1C1A76ED395');
        $this->addSql('DROP TABLE convention_user');
    }
}
