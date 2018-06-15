<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180614123537 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, users INT DEFAULT NULL, title VARCHAR(150) NOT NULL, content LONGTEXT NOT NULL, goal INT NOT NULL, status INT NOT NULL, actived INT NOT NULL, UNIQUE INDEX UNIQ_BFDD31682B36786B (title), INDEX IDX_BFDD31681483A5E9 (users), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contributor (id INT AUTO_INCREMENT NOT NULL, users INT DEFAULT NULL, articles INT DEFAULT NULL, value INT NOT NULL, submit_at DATETIME NOT NULL, INDEX IDX_DA6F97931483A5E9 (users), INDEX IDX_DA6F9793BFDD3168 (articles), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(150) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31681483A5E9 FOREIGN KEY (users) REFERENCES users (id)');
        $this->addSql('ALTER TABLE contributor ADD CONSTRAINT FK_DA6F97931483A5E9 FOREIGN KEY (users) REFERENCES users (id)');
        $this->addSql('ALTER TABLE contributor ADD CONSTRAINT FK_DA6F9793BFDD3168 FOREIGN KEY (articles) REFERENCES articles (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contributor DROP FOREIGN KEY FK_DA6F9793BFDD3168');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31681483A5E9');
        $this->addSql('ALTER TABLE contributor DROP FOREIGN KEY FK_DA6F97931483A5E9');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE contributor');
        $this->addSql('DROP TABLE users');
    }
}
