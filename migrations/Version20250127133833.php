<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127133833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB409D86650F');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB40E85F12B8');
        $this->addSql('DROP INDEX IDX_4923CB40E85F12B8 ON retweets');
        $this->addSql('DROP INDEX IDX_4923CB409D86650F ON retweets');
        $this->addSql('ALTER TABLE retweets ADD post_id INT NOT NULL, ADD user_id INT NOT NULL, DROP post_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB404B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB40A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4923CB404B89032C ON retweets (post_id)');
        $this->addSql('CREATE INDEX IDX_4923CB40A76ED395 ON retweets (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB404B89032C');
        $this->addSql('ALTER TABLE retweets DROP FOREIGN KEY FK_4923CB40A76ED395');
        $this->addSql('DROP INDEX IDX_4923CB404B89032C ON retweets');
        $this->addSql('DROP INDEX IDX_4923CB40A76ED395 ON retweets');
        $this->addSql('ALTER TABLE retweets ADD post_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP post_id, DROP user_id');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB409D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE retweets ADD CONSTRAINT FK_4923CB40E85F12B8 FOREIGN KEY (post_id_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_4923CB40E85F12B8 ON retweets (post_id_id)');
        $this->addSql('CREATE INDEX IDX_4923CB409D86650F ON retweets (user_id_id)');
    }
}
