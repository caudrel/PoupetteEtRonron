<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230712184548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beverage (id INT AUTO_INCREMENT NOT NULL, beverage_category_id_id INT DEFAULT NULL, beverage_name VARCHAR(50) NOT NULL, description VARCHAR(200) DEFAULT NULL, is_activ TINYINT(1) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_3D8CACBBC36ED614 (beverage_category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beverage_category (id INT AUTO_INCREMENT NOT NULL, beverage_category_name VARCHAR(35) NOT NULL, is_activ TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_form (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(60) NOT NULL, is_valid TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(100) NOT NULL, answer LONGTEXT NOT NULL, is_activ TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, food_category_id_id INT DEFAULT NULL, food_name VARCHAR(50) NOT NULL, description VARCHAR(200) NOT NULL, is_vegetarian TINYINT(1) DEFAULT NULL, is_activ TINYINT(1) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D43829F7F9261ED5 (food_category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_category (id INT AUTO_INCREMENT NOT NULL, food_category_name VARCHAR(35) NOT NULL, is_activ TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opening_hours (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(10) NOT NULL, description VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beverage ADD CONSTRAINT FK_3D8CACBBC36ED614 FOREIGN KEY (beverage_category_id_id) REFERENCES beverage_category (id)');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7F9261ED5 FOREIGN KEY (food_category_id_id) REFERENCES food_category (id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBBC36ED614');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7F9261ED5');
        $this->addSql('DROP TABLE beverage');
        $this->addSql('DROP TABLE beverage_category');
        $this->addSql('DROP TABLE contact_form');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE food_category');
        $this->addSql('DROP TABLE opening_hours');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
