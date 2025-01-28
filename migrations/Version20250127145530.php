<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127145530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D9D86650F');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DE85F12B8');
        $this->addSql('DROP INDEX IDX_49CA4E7DE85F12B8 ON likes');
        $this->addSql('DROP INDEX IDX_49CA4E7D9D86650F ON likes');
        $this->addSql('ALTER TABLE likes ADD post_id INT NOT NULL, ADD user_id INT NOT NULL, DROP post_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_49CA4E7D4B89032C ON likes (post_id)');
        $this->addSql('CREATE INDEX IDX_49CA4E7DA76ED395 ON likes (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D4B89032C');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7DA76ED395');
        $this->addSql('DROP INDEX IDX_49CA4E7D4B89032C ON likes');
        $this->addSql('DROP INDEX IDX_49CA4E7DA76ED395 ON likes');
        $this->addSql('ALTER TABLE likes ADD post_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP post_id, DROP user_id');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DE85F12B8 FOREIGN KEY (post_id_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_49CA4E7DE85F12B8 ON likes (post_id_id)');
        $this->addSql('CREATE INDEX IDX_49CA4E7D9D86650F ON likes (user_id_id)');
    }
}
