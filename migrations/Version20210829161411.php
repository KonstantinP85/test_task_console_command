<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210829161411 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Table logs: change response_body';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE logs ALTER response_body TYPE TEXT');
        $this->addSql('ALTER TABLE logs ALTER response_body DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE logs ALTER response_body TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE logs ALTER response_body DROP DEFAULT');
    }
}
