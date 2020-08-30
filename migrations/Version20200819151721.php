<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819151721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aquarelle ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aquarelle ADD CONSTRAINT FK_8AA40492642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_8AA40492642B8210 ON aquarelle (admin_id)');
        $this->addSql('ALTER TABLE photo ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_14B78418642B8210 ON photo (admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aquarelle DROP FOREIGN KEY FK_8AA40492642B8210');
        $this->addSql('DROP INDEX IDX_8AA40492642B8210 ON aquarelle');
        $this->addSql('ALTER TABLE aquarelle DROP admin_id');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418642B8210');
        $this->addSql('DROP INDEX IDX_14B78418642B8210 ON photo');
        $this->addSql('ALTER TABLE photo DROP admin_id');
    }
}
