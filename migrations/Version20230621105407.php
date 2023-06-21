<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621105407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE section_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE section (id INT NOT NULL, field_id INT NOT NULL, course_id INT NOT NULL, semester VARCHAR(100) NOT NULL, year DATE NOT NULL, room_no VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D737AEF443707B0 ON section (field_id)');
        $this->addSql('CREATE INDEX IDX_2D737AEF591CC992 ON section (course_id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF443707B0 FOREIGN KEY (field_id) REFERENCES field (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF591CC992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE section_id_seq CASCADE');
        $this->addSql('ALTER TABLE section DROP CONSTRAINT FK_2D737AEF443707B0');
        $this->addSql('ALTER TABLE section DROP CONSTRAINT FK_2D737AEF591CC992');
        $this->addSql('DROP TABLE section');
    }
}
