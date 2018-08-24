<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180824144928 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_D8F0A91E5E237E06 ON trick (name)');
        $this->addSql('ALTER TABLE category CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD avatar VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE slug slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE description description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        //$this->addSql('DROP INDEX UNIQ_D8F0A91E5E237E06 ON trick');
        $this->addSql('ALTER TABLE trick CHANGE slug slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user DROP avatar');
    }
}
