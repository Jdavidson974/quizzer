<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215144356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resultat_quiz ADD quiz_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resultat_quiz ADD CONSTRAINT FK_2A776B3853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_2A776B3853CD175 ON resultat_quiz (quiz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resultat_quiz DROP FOREIGN KEY FK_2A776B3853CD175');
        $this->addSql('DROP INDEX IDX_2A776B3853CD175 ON resultat_quiz');
        $this->addSql('ALTER TABLE resultat_quiz DROP quiz_id');
    }
}
