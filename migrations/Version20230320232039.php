<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230320232039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id2 VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, genre VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, director VARCHAR(255) DEFAULT NULL, year VARCHAR(255) DEFAULT NULL, runtime VARCHAR(255) DEFAULT NULL, rate VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE xml_file (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, xml_filename VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE xml_file');
    }
}
