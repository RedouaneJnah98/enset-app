<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620103750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field ADD department_id INT NOT NULL');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF54558AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5BF54558AE80F5DF ON field (department_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE field DROP CONSTRAINT FK_5BF54558AE80F5DF');
        $this->addSql('DROP INDEX IDX_5BF54558AE80F5DF');
        $this->addSql('ALTER TABLE field DROP department_id');
    }
}
