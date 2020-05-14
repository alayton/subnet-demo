<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513215712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ip_address ADD subnet_id INT NOT NULL');
        $this->addSql('ALTER TABLE ip_address ADD CONSTRAINT FK_22FFD58CC9CF9478 FOREIGN KEY (subnet_id) REFERENCES subnet (id)');
        $this->addSql('CREATE INDEX IDX_22FFD58CC9CF9478 ON ip_address (subnet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ip_address DROP FOREIGN KEY FK_22FFD58CC9CF9478');
        $this->addSql('DROP INDEX IDX_22FFD58CC9CF9478 ON ip_address');
        $this->addSql('ALTER TABLE ip_address DROP subnet_id');
    }
}
