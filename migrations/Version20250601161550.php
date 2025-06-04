<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250601161550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP FOREIGN KEY FK_C53D045F181A8BA
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_C53D045F181A8BA ON image
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP voiture_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD image_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E9E2810F3DA5256D ON voiture (image_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD voiture_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD CONSTRAINT FK_C53D045F181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_C53D045F181A8BA ON image (voiture_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F3DA5256D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_E9E2810F3DA5256D ON voiture
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP image_id
        SQL);
    }
}
