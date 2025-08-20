<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250820080533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE convention (id INT AUTO_INCREMENT NOT NULL, society_id INT NOT NULL, student_id INT NOT NULL, commander_id INT NOT NULL, afpa_director_id INT NOT NULL, formation_id INT NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, progress INT NOT NULL, INDEX IDX_8556657EE6389D24 (society_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE convention_user (convention_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B469C1C1A2ACEBCC (convention_id), INDEX IDX_B469C1C1A76ED395 (user_id), PRIMARY KEY(convention_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, sigle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, siren INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, telephone VARCHAR(100) NOT NULL, matricule VARCHAR(100) NOT NULL, INDEX IDX_8D93D6495200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convention ADD CONSTRAINT FK_8556657EE6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('ALTER TABLE convention_user ADD CONSTRAINT FK_B469C1C1A2ACEBCC FOREIGN KEY (convention_id) REFERENCES convention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE convention_user ADD CONSTRAINT FK_B469C1C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention DROP FOREIGN KEY FK_8556657EE6389D24');
        $this->addSql('ALTER TABLE convention_user DROP FOREIGN KEY FK_B469C1C1A2ACEBCC');
        $this->addSql('ALTER TABLE convention_user DROP FOREIGN KEY FK_B469C1C1A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495200282E');
        $this->addSql('DROP TABLE convention');
        $this->addSql('DROP TABLE convention_user');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
