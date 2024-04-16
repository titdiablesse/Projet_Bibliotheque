<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416113714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, book_id INT DEFAULT NULL, com_user_id INT DEFAULT NULL, date_ajout DATETIME NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_D9BEC0C416A2B381 (book_id), INDEX IDX_D9BEC0C49975955A (com_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emprunt_livre (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, user_id INT NOT NULL, date_emprunt DATETIME NOT NULL, date_restitution DATETIME NOT NULL, date_restituion_effective DATETIME NOT NULL, INDEX IDX_562087F216A2B381 (book_id), INDEX IDX_562087F2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipements (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, type_etat VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, room_id INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_42C84955A76ED395 (user_id), INDEX IDX_42C8495554177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_equipements (room_id INT NOT NULL, equipements_id INT NOT NULL, INDEX IDX_2B37765454177093 (room_id), INDEX IDX_2B377654852CCFF5 (equipements_id), PRIMARY KEY(room_id, equipements_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C416A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C49975955A FOREIGN KEY (com_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE emprunt_livre ADD CONSTRAINT FK_562087F216A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE emprunt_livre ADD CONSTRAINT FK_562087F2A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE room_equipements ADD CONSTRAINT FK_2B37765454177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_equipements ADD CONSTRAINT FK_2B377654852CCFF5 FOREIGN KEY (equipements_id) REFERENCES equipements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book ADD etat_id INT NOT NULL, ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331D5E86FF ON book (etat_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331BCF5E72D ON book (categorie_id)');
        $this->addSql('ALTER TABLE room DROP equipments, DROP disponibility, DROP reservation_duration');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331D5E86FF');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C416A2B381');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C49975955A');
        $this->addSql('ALTER TABLE emprunt_livre DROP FOREIGN KEY FK_562087F216A2B381');
        $this->addSql('ALTER TABLE emprunt_livre DROP FOREIGN KEY FK_562087F2A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495554177093');
        $this->addSql('ALTER TABLE room_equipements DROP FOREIGN KEY FK_2B37765454177093');
        $this->addSql('ALTER TABLE room_equipements DROP FOREIGN KEY FK_2B377654852CCFF5');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE emprunt_livre');
        $this->addSql('DROP TABLE equipements');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE room_equipements');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331BCF5E72D');
        $this->addSql('DROP INDEX IDX_CBE5A331D5E86FF ON book');
        $this->addSql('DROP INDEX IDX_CBE5A331BCF5E72D ON book');
        $this->addSql('ALTER TABLE book DROP etat_id, DROP categorie_id');
        $this->addSql('ALTER TABLE room ADD equipments LONGTEXT NOT NULL, ADD disponibility TINYINT(1) NOT NULL, ADD reservation_duration VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\'');
    }
}
