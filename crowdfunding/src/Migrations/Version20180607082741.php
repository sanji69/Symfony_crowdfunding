<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180607082741 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX title ON articles');
        $this->addSql('ALTER TABLE articles CHANGE title title VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX username ON users');
        $this->addSql('DROP INDEX email ON users');
        $this->addSql('DROP INDEX token ON users');
        $this->addSql('ALTER TABLE users CHANGE username username VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE token token VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles CHANGE title title VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX title ON articles (title)');
        $this->addSql('ALTER TABLE users CHANGE username username VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE token token VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE roles roles VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX username ON users (username)');
        $this->addSql('CREATE UNIQUE INDEX email ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX token ON users (token)');
    }
}
