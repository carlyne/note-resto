<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200603101527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0B1E7706E ON avis (restaurant_id)');
        $this->addSql('ALTER TABLE rating ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_D8892622B1E7706E ON rating (restaurant_id)');
        $this->addSql('ALTER TABLE restaurant ADD restaurateur_id_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD src_image VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F8BEFA8EC FOREIGN KEY (restaurateur_id_id) REFERENCES restaurateur (id)');
        $this->addSql('CREATE INDEX IDX_EB95123F8BEFA8EC ON restaurant (restaurateur_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0B1E7706E');
        $this->addSql('DROP INDEX IDX_8F91ABF0B1E7706E ON avis');
        $this->addSql('ALTER TABLE avis DROP restaurant_id');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622B1E7706E');
        $this->addSql('DROP INDEX IDX_D8892622B1E7706E ON rating');
        $this->addSql('ALTER TABLE rating DROP restaurant_id');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F8BEFA8EC');
        $this->addSql('DROP INDEX IDX_EB95123F8BEFA8EC ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP restaurateur_id_id, DROP created_at, DROP src_image, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
