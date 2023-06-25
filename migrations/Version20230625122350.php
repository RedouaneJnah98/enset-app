<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230625122350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE section_user (section_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(section_id, user_id))');
        $this->addSql('CREATE INDEX IDX_82D3A42D823E37A ON section_user (section_id)');
        $this->addSql('CREATE INDEX IDX_82D3A42A76ED395 ON section_user (user_id)');
        $this->addSql('ALTER TABLE section_user ADD CONSTRAINT FK_82D3A42D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE section_user ADD CONSTRAINT FK_82D3A42A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE section_user DROP CONSTRAINT FK_82D3A42D823E37A');
        $this->addSql('ALTER TABLE section_user DROP CONSTRAINT FK_82D3A42A76ED395');
        $this->addSql('DROP TABLE section_user');
    }
}
