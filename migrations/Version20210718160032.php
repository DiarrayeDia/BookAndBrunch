<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718160032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments ADD written_by_id INT NOT NULL, ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AAB69C8EF FOREIGN KEY (written_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A16A2B381 FOREIGN KEY (book_id) REFERENCES books (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AAB69C8EF ON comments (written_by_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A16A2B381 ON comments (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AAB69C8EF');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A16A2B381');
        $this->addSql('DROP INDEX IDX_5F9E962AAB69C8EF ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A16A2B381 ON comments');
        $this->addSql('ALTER TABLE comments DROP written_by_id, DROP book_id');
    }
}
