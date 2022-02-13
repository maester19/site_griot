<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220212115912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, storie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_8C62B0253DF3EA3D (storie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B0253DF3EA3D FOREIGN KEY (storie_id) REFERENCES storie (id)');
        $this->addSql('ALTER TABLE storie DROP chap');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('ALTER TABLE storie ADD chap LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
