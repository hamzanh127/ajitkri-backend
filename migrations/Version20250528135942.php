<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250528135942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD marque_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E9E2810F4827B9B2 ON voiture (marque_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F4827B9B2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E9E2810F4827B9B2 ON voiture
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP marque_id
        SQL);
    }
}
