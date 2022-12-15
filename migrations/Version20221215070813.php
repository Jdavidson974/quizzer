<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215070813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_reponse (question_id INT NOT NULL, reponse_id INT NOT NULL, INDEX IDX_516A0BDA1E27F6BF (question_id), INDEX IDX_516A0BDACF18BB82 (reponse_id), PRIMARY KEY(question_id, reponse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_reponse ADD CONSTRAINT FK_516A0BDA1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_reponse ADD CONSTRAINT FK_516A0BDACF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_reponse DROP FOREIGN KEY FK_516A0BDA1E27F6BF');
        $this->addSql('ALTER TABLE question_reponse DROP FOREIGN KEY FK_516A0BDACF18BB82');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_reponse');
    }
}
