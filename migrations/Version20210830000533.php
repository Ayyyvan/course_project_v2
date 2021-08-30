<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210830000533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE collection_theme_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE collection_theme (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE own_collection ADD collection_theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE own_collection ADD CONSTRAINT FK_F997A374A882BAB7 FOREIGN KEY (collection_theme_id) REFERENCES collection_theme (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F997A374A882BAB7 ON own_collection (collection_theme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE own_collection DROP CONSTRAINT FK_F997A374A882BAB7');
        $this->addSql('DROP SEQUENCE collection_theme_id_seq CASCADE');
        $this->addSql('DROP TABLE collection_theme');
        $this->addSql('DROP INDEX IDX_F997A374A882BAB7');
        $this->addSql('ALTER TABLE own_collection DROP collection_theme_id');
    }
}
