<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128203305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_following ADD following_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_following ADD CONSTRAINT FK_715F0007A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_715F0007A76ED395 ON user_following (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_following DROP FOREIGN KEY FK_715F0007A76ED395');
        $this->addSql('DROP INDEX IDX_715F0007A76ED395 ON user_following');
        $this->addSql('ALTER TABLE user_following DROP following_user_id');
    }
}
