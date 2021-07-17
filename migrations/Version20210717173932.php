<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210717173932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE books (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, year INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, summary LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, translation TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE books_authors (books_id INT NOT NULL, authors_id INT NOT NULL, INDEX IDX_877EACC27DD8AC20 (books_id), INDEX IDX_877EACC26DE2013A (authors_id), PRIMARY KEY(books_id, authors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE books_authors ADD CONSTRAINT FK_877EACC27DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE books_authors ADD CONSTRAINT FK_877EACC26DE2013A FOREIGN KEY (authors_id) REFERENCES authors (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books_authors DROP FOREIGN KEY FK_877EACC27DD8AC20');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE books_authors');
    }
}
