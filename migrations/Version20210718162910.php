<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718162910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookshelf (id INT AUTO_INCREMENT NOT NULL, year INT NOT NULL, month VARCHAR(20) NOT NULL, photos VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE books ADD bookshelf_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A929B7A322B FOREIGN KEY (bookshelf_id) REFERENCES bookshelf (id)');
        $this->addSql('CREATE INDEX IDX_4A1B2A929B7A322B ON books (bookshelf_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A929B7A322B');
        $this->addSql('DROP TABLE bookshelf');
        $this->addSql('DROP INDEX IDX_4A1B2A929B7A322B ON books');
        $this->addSql('ALTER TABLE books DROP bookshelf_id');
    }
}
