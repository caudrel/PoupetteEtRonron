<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230806150746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_subject (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(255) NOT NULL, is_valid TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE contact_form');
        $this->addSql('ALTER TABLE beverage CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE beverage_category CHANGE beverage_category_name beverage_category_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE faq CHANGE question question VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE food CHANGE food_name food_name VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE food_category CHANGE food_category_name food_category_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_form (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_valid TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE contact_subject');
        $this->addSql('ALTER TABLE beverage CHANGE description description VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE food CHANGE food_name food_name VARCHAR(50) NOT NULL, CHANGE description description VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE faq CHANGE question question VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE food_category CHANGE food_category_name food_category_name VARCHAR(35) NOT NULL');
        $this->addSql('ALTER TABLE beverage_category CHANGE beverage_category_name beverage_category_name VARCHAR(35) NOT NULL');
    }
}
