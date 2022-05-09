<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503143926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blogpost DROP FOREIGN KEY FK_1284FB7DA76ED395');
        $this->addSql('DROP INDEX IDX_1284FB7DA76ED395 ON blogpost');
        $this->addSql('ALTER TABLE blogpost DROP user_id');
        $this->addSql('ALTER TABLE commentaire ADD is_published TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE contact CHANGE prenom prenom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blogpost ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE blogpost ADD CONSTRAINT FK_1284FB7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1284FB7DA76ED395 ON blogpost (user_id)');
        $this->addSql('ALTER TABLE commentaire DROP is_published');
        $this->addSql('ALTER TABLE contact CHANGE prenom prenom TEXT NOT NULL');
    }
}
