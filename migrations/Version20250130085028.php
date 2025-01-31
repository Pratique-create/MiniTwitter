<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130085028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D4B89032C');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB40A76ED395');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB404B89032C');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB40A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB404B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE comment DROP created_at');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D4B89032C');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB404B89032C');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB40A76ED395');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB404B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB40A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130085028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D4B89032C');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB40A76ED395');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB404B89032C');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB40A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB404B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE comment DROP created_at');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D4B89032C');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB404B89032C');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB40A76ED395');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB404B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB40A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}