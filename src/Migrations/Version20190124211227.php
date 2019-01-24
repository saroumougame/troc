<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190124211227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479836C1031');
        $this->addSql('CREATE TABLE msg (id INT AUTO_INCREMENT NOT NULL, id_sender_id INT NOT NULL, id_receiver_id INT NOT NULL, message LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_688A5FAF76110FBA (id_sender_id), INDEX IDX_688A5FAFD5412041 (id_receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE msg ADD CONSTRAINT FK_688A5FAF76110FBA FOREIGN KEY (id_sender_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE msg ADD CONSTRAINT FK_688A5FAFD5412041 FOREIGN KEY (id_receiver_id) REFERENCES fos_user (id)');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('ALTER TABLE amis CHANGE user_id user_id INT DEFAULT NULL, CHANGE amis_id amis_id INT DEFAULT NULL, CHANGE status status VARCHAR(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE objet CHANGE user_id user_id INT DEFAULT NULL, CHANGE created_by_id created_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(500) DEFAULT NULL, CHANGE namephoto namephoto VARCHAR(100) DEFAULT NULL, CHANGE remove remove TINYINT(1) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_957A6479836C1031 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP messagerie_id, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE namephoto namephoto VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE echange CHANGE user_vendeur_id user_vendeur_id INT DEFAULT NULL, CHANGE user_acheteur_id user_acheteur_id INT DEFAULT NULL, CHANGE object_vendeur_id object_vendeur_id INT DEFAULT NULL, CHANGE object_achteur_id object_achteur_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE msg');
        $this->addSql('ALTER TABLE amis CHANGE user_id user_id INT DEFAULT NULL, CHANGE amis_id amis_id INT DEFAULT NULL, CHANGE status status VARCHAR(1) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE echange CHANGE user_vendeur_id user_vendeur_id INT DEFAULT NULL, CHANGE user_acheteur_id user_acheteur_id INT DEFAULT NULL, CHANGE object_vendeur_id object_vendeur_id INT DEFAULT NULL, CHANGE object_achteur_id object_achteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD messagerie_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE namephoto namephoto VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id)');
        $this->addSql('CREATE INDEX IDX_957A6479836C1031 ON fos_user (messagerie_id)');
        $this->addSql('ALTER TABLE objet CHANGE user_id user_id INT DEFAULT NULL, CHANGE created_by_id created_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE remove remove TINYINT(1) DEFAULT \'NULL\', CHANGE namephoto namephoto VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
