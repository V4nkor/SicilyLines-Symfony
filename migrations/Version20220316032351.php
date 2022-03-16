<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316032351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bateau_equipement (bateau_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_A2B506B1A9706509 (bateau_id), INDEX IDX_A2B506B1806F0F5C (equipement_id), PRIMARY KEY(bateau_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bateau_equipement ADD CONSTRAINT FK_A2B506B1A9706509 FOREIGN KEY (bateau_id) REFERENCES bateau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bateau_equipement ADD CONSTRAINT FK_A2B506B1806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bateau_equipement');
        $this->addSql('DROP TABLE categorie');
    }
}
