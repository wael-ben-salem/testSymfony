<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014215208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, usename VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, auth_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, publicate_date VARCHAR(255) DEFAULT NULL, category VARCHAR(255) NOT NULL, published TINYINT(1) DEFAULT NULL, INDEX IDX_CBE5A3318082819C (auth_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3318082819C FOREIGN KEY (auth_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE vol CHANGE date_de_départ date_de_départ DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE date_darrivée date_darrivée DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3318082819C');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('ALTER TABLE vol CHANGE date_de_départ date_de_départ DATETIME NOT NULL, CHANGE date_darrivée date_darrivée DATETIME NOT NULL');
    }
}
