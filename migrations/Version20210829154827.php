<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210829154827 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Create table: logs';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE logs (id UUID NOT NULL, request_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, request_method VARCHAR(255) NOT NULL, request_url VARCHAR(255) NOT NULL, response_code INT NOT NULL, response_body VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql("COMMENT ON COLUMN logs.request_time IS '(DC2Type:datetime_immutable)'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE logs');
    }
}
