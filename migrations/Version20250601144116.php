<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250601144116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD voiture_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD CONSTRAINT FK_C53D045F181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_C53D045F181A8BA ON image (voiture_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP FOREIGN KEY FK_C53D045F181A8BA
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_C53D045F181A8BA ON image
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP voiture_id
        SQL);
    }
}
