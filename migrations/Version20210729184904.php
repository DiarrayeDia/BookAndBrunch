<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729184904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_genre (book_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_8D92268116A2B381 (book_id), INDEX IDX_8D9226814296D31F (genre_id), PRIMARY KEY(book_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_area (book_id INT NOT NULL, area_id INT NOT NULL, INDEX IDX_CE09766016A2B381 (book_id), INDEX IDX_CE097660BD0F409C (area_id), PRIMARY KEY(book_id, area_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D92268116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D9226814296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_area ADD CONSTRAINT FK_CE09766016A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_area ADD CONSTRAINT FK_CE097660BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE area_book');
        $this->addSql('DROP TABLE genre_book');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area_book (area_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_9A08C2EBD0F409C (area_id), INDEX IDX_9A08C2E16A2B381 (book_id), PRIMARY KEY(area_id, book_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE genre_book (genre_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_70087AC14296D31F (genre_id), INDEX IDX_70087AC116A2B381 (book_id), PRIMARY KEY(genre_id, book_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE area_book ADD CONSTRAINT FK_9A08C2E16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE area_book ADD CONSTRAINT FK_9A08C2EBD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_book ADD CONSTRAINT FK_70087AC116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_book ADD CONSTRAINT FK_70087AC14296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE book_genre');
        $this->addSql('DROP TABLE book_area');
    }
}
