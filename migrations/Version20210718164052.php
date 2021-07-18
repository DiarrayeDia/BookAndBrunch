<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718164052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(120) NOT NULL, INDEX IDX_D7943D68727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE area_books (area_id INT NOT NULL, books_id INT NOT NULL, INDEX IDX_C7D16248BD0F409C (area_id), INDEX IDX_C7D162487DD8AC20 (books_id), PRIMARY KEY(area_id, books_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE area ADD CONSTRAINT FK_D7943D68727ACA70 FOREIGN KEY (parent_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE area_books ADD CONSTRAINT FK_C7D16248BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE area_books ADD CONSTRAINT FK_C7D162487DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE area DROP FOREIGN KEY FK_D7943D68727ACA70');
        $this->addSql('ALTER TABLE area_books DROP FOREIGN KEY FK_C7D16248BD0F409C');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE area_books');
    }
}
