<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522143813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE p_title p_title VARCHAR(255) DEFAULT NULL, CHANGE p_price p_price VARCHAR(255) DEFAULT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE products DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE products CHANGE id id INT DEFAULT NULL, CHANGE p_title p_title TEXT DEFAULT NULL COLLATE utf8mb4_general_ci, CHANGE p_price p_price INT DEFAULT NULL');
    }
}
