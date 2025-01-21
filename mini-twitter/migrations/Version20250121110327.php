<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121110327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE likes (id INT AUTO_INCREMENT NOT NULL, post_id_id INT NOT NULL, user_id_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_49CA4E7DE85F12B8 (post_id_id), INDEX IDX_49CA4E7D9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_885DBAFA9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retweets (id INT AUTO_INCREMENT NOT NULL, post_id_id INT NOT NULL, user_id_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4923CB40E85F12B8 (post_id_id), INDEX IDX_4923CB409D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, number INT DEFAULT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(255) NOT NULL, profile_picture LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DE85F12B8 FOREIGN KEY (post_id_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB40E85F12B8 FOREIGN KEY (post_id_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB409D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DE85F12B8');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D9D86650F');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA9D86650F');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB40E85F12B8');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB409D86650F');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE retweets');
        $this->addSql('DROP TABLE user');
    }
}
