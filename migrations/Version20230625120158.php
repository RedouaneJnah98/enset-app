<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230625120158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section ADD course_id INT NOT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF591CC992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2D737AEF591CC992 ON section (course_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE section DROP CONSTRAINT FK_2D737AEF591CC992');
        $this->addSql('DROP INDEX IDX_2D737AEF591CC992');
        $this->addSql('ALTER TABLE section DROP course_id');
    }
}
