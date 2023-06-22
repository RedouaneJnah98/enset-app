<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621123251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD field_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33443707B0 FOREIGN KEY (field_id) REFERENCES field (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B723AF33443707B0 ON student (field_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT FK_B723AF33443707B0');
        $this->addSql('DROP INDEX IDX_B723AF33443707B0');
        $this->addSql('ALTER TABLE student DROP field_id');
    }
}
