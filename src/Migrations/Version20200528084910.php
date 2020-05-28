<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528084910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE restaurateur (id INT AUTO_INCREMENT NOT NULL, nom LONGTEXT NOT NULL, first_name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurateur_restaurant (restaurateur_id INT NOT NULL, restaurant_id INT NOT NULL, INDEX IDX_FC3F1A7F3B311E56 (restaurateur_id), INDEX IDX_FC3F1A7FB1E7706E (restaurant_id), PRIMARY KEY(restaurateur_id, restaurant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE restaurateur_restaurant ADD CONSTRAINT FK_FC3F1A7F3B311E56 FOREIGN KEY (restaurateur_id) REFERENCES restaurateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurateur_restaurant ADD CONSTRAINT FK_FC3F1A7FB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE article');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE restaurateur_restaurant DROP FOREIGN KEY FK_FC3F1A7F3B311E56');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, src_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE restaurateur');
        $this->addSql('DROP TABLE restaurateur_restaurant');
    }
}
