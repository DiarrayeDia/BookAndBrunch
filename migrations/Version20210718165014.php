<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718165014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, link VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_5387574A61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events_user (events_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E1C3D2339D6A1065 (events_id), INDEX IDX_E1C3D233A76ED395 (user_id), PRIMARY KEY(events_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE events_user ADD CONSTRAINT FK_E1C3D2339D6A1065 FOREIGN KEY (events_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events_user ADD CONSTRAINT FK_E1C3D233A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events_user DROP FOREIGN KEY FK_E1C3D2339D6A1065');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE events_user');
    }
}