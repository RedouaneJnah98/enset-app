<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230625133344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section ALTER field_id SET NOT NULL');
        $this->addSql('ALTER TABLE section_user DROP CONSTRAINT FK_82D3A42D823E37A');
        $this->addSql('ALTER TABLE section_user ADD CONSTRAINT FK_82D3A42D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE section_user DROP CONSTRAINT fk_82d3a42d823e37a');
        $this->addSql('ALTER TABLE section_user ADD CONSTRAINT fk_82d3a42d823e37a FOREIGN KEY (section_id) REFERENCES section (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE section ALTER field_id DROP NOT NULL');
    }
}
