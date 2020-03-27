<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326085622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE master (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, magic_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE servant ADD master_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE servant ADD CONSTRAINT FK_309095D513B3DB11 FOREIGN KEY (master_id) REFERENCES master (id)');
        $this->addSql('CREATE INDEX IDX_309095D513B3DB11 ON servant (master_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servant DROP FOREIGN KEY FK_309095D513B3DB11');
        $this->addSql('DROP TABLE master');
        $this->addSql('DROP INDEX IDX_309095D513B3DB11 ON servant');
        $this->addSql('ALTER TABLE servant DROP master_id');
    }
}
