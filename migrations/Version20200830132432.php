<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200830132432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo ADD album_photo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188D72EA99 FOREIGN KEY (album_photo_id) REFERENCES album_photo (id)');
        $this->addSql('CREATE INDEX IDX_14B784188D72EA99 ON photo (album_photo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188D72EA99');
        $this->addSql('DROP INDEX IDX_14B784188D72EA99 ON photo');
        $this->addSql('ALTER TABLE photo DROP album_photo_id');
    }
}
