<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210828011216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table: news';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE news (id UUID NOT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, short_description VARCHAR(1000) NOT NULL, publish_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, author VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql("COMMENT ON COLUMN news.publish_time IS '(DC2Type:datetime_immutable)'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE news');
    }
}
