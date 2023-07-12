<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230712185407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBBC36ED614');
        $this->addSql('DROP INDEX IDX_3D8CACBBC36ED614 ON beverage');
        $this->addSql('ALTER TABLE beverage CHANGE beverage_category_id_id beverage_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beverage ADD CONSTRAINT FK_3D8CACBB91A73473 FOREIGN KEY (beverage_category_id) REFERENCES beverage_category (id)');
        $this->addSql('CREATE INDEX IDX_3D8CACBB91A73473 ON beverage (beverage_category_id)');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7F9261ED5');
        $this->addSql('DROP INDEX IDX_D43829F7F9261ED5 ON food');
        $this->addSql('ALTER TABLE food CHANGE food_category_id_id food_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7B3F04B2C FOREIGN KEY (food_category_id) REFERENCES food_category (id)');
        $this->addSql('CREATE INDEX IDX_D43829F7B3F04B2C ON food (food_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beverage DROP FOREIGN KEY FK_3D8CACBB91A73473');
        $this->addSql('DROP INDEX IDX_3D8CACBB91A73473 ON beverage');
        $this->addSql('ALTER TABLE beverage CHANGE beverage_category_id beverage_category_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beverage ADD CONSTRAINT FK_3D8CACBBC36ED614 FOREIGN KEY (beverage_category_id_id) REFERENCES beverage_category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3D8CACBBC36ED614 ON beverage (beverage_category_id_id)');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F7B3F04B2C');
        $this->addSql('DROP INDEX IDX_D43829F7B3F04B2C ON food');
        $this->addSql('ALTER TABLE food CHANGE food_category_id food_category_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7F9261ED5 FOREIGN KEY (food_category_id_id) REFERENCES food_category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D43829F7F9261ED5 ON food (food_category_id_id)');
    }
}
