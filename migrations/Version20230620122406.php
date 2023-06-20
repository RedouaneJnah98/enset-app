<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620122406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD image_size VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE student ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33F85E0677 ON student (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_B723AF33F85E0677');
        $this->addSql('ALTER TABLE student DROP image_name');
        $this->addSql('ALTER TABLE student DROP image_size');
        $this->addSql('ALTER TABLE student DROP created_at');
        $this->addSql('ALTER TABLE student DROP updated_at');
    }
}
