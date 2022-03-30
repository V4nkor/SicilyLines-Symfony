<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330101147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liaison_periode (liaison_id INT NOT NULL, periode_id INT NOT NULL, INDEX IDX_C529E815ED31185 (liaison_id), INDEX IDX_C529E815F384C1CF (periode_id), PRIMARY KEY(liaison_id, periode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_periode (type_id INT NOT NULL, periode_id INT NOT NULL, INDEX IDX_BBE24206C54C8C93 (type_id), INDEX IDX_BBE24206F384C1CF (periode_id), PRIMARY KEY(type_id, periode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liaison_periode ADD CONSTRAINT FK_C529E815ED31185 FOREIGN KEY (liaison_id) REFERENCES liaison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liaison_periode ADD CONSTRAINT FK_C529E815F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_periode ADD CONSTRAINT FK_BBE24206C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_periode ADD CONSTRAINT FK_BBE24206F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD client_reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045599F1D568 FOREIGN KEY (client_reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C744045599F1D568 ON client (client_reservation_id)');
        $this->addSql('ALTER TABLE liaison ADD liaison_port_id INT DEFAULT NULL, ADD liaison_secteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC372003EF7A FOREIGN KEY (liaison_port_id) REFERENCES port (id)');
        $this->addSql('ALTER TABLE liaison ADD CONSTRAINT FK_225AC37C443C02C FOREIGN KEY (liaison_secteur_id) REFERENCES secteur (id)');
        $this->addSql('CREATE INDEX IDX_225AC372003EF7A ON liaison (liaison_port_id)');
        $this->addSql('CREATE INDEX IDX_225AC37C443C02C ON liaison (liaison_secteur_id)');
        $this->addSql('ALTER TABLE reservation ADD reservation_traversee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558F3AC059 FOREIGN KEY (reservation_traversee_id) REFERENCES traversee (id)');
        $this->addSql('CREATE INDEX IDX_42C849558F3AC059 ON reservation (reservation_traversee_id)');
        $this->addSql('ALTER TABLE traversee ADD traversee_liaison_id INT DEFAULT NULL, ADD traversee_bateau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traversee ADD CONSTRAINT FK_B688F50197670497 FOREIGN KEY (traversee_liaison_id) REFERENCES liaison (id)');
        $this->addSql('ALTER TABLE traversee ADD CONSTRAINT FK_B688F5011434CD0A FOREIGN KEY (traversee_bateau_id) REFERENCES bateau (id)');
        $this->addSql('CREATE INDEX IDX_B688F50197670497 ON traversee (traversee_liaison_id)');
        $this->addSql('CREATE INDEX IDX_B688F5011434CD0A ON traversee (traversee_bateau_id)');
        $this->addSql('ALTER TABLE type ADD type_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57293BB65D28 FOREIGN KEY (type_categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_8CDE57293BB65D28 ON type (type_categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE liaison_periode');
        $this->addSql('DROP TABLE type_periode');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045599F1D568');
        $this->addSql('DROP INDEX UNIQ_C744045599F1D568 ON client');
        $this->addSql('ALTER TABLE client DROP client_reservation_id');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC372003EF7A');
        $this->addSql('ALTER TABLE liaison DROP FOREIGN KEY FK_225AC37C443C02C');
        $this->addSql('DROP INDEX IDX_225AC372003EF7A ON liaison');
        $this->addSql('DROP INDEX IDX_225AC37C443C02C ON liaison');
        $this->addSql('ALTER TABLE liaison DROP liaison_port_id, DROP liaison_secteur_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558F3AC059');
        $this->addSql('DROP INDEX IDX_42C849558F3AC059 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP reservation_traversee_id');
        $this->addSql('ALTER TABLE traversee DROP FOREIGN KEY FK_B688F50197670497');
        $this->addSql('ALTER TABLE traversee DROP FOREIGN KEY FK_B688F5011434CD0A');
        $this->addSql('DROP INDEX IDX_B688F50197670497 ON traversee');
        $this->addSql('DROP INDEX IDX_B688F5011434CD0A ON traversee');
        $this->addSql('ALTER TABLE traversee DROP traversee_liaison_id, DROP traversee_bateau_id');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57293BB65D28');
        $this->addSql('DROP INDEX IDX_8CDE57293BB65D28 ON type');
        $this->addSql('ALTER TABLE type DROP type_categorie_id');
    }
}
