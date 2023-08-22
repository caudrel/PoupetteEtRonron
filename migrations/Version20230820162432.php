<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820162432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beverage CHANGE beverage_name beverage_name VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE opening_hours CHANGE day day VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE test_entity');
        $this->addSql('ALTER TABLE beverage CHANGE beverage_name beverage_name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE opening_hours CHANGE day day VARCHAR(20) NOT NULL, CHANGE description description VARCHAR(60) NOT NULL');
    }
}
