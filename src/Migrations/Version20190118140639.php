<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190118140639 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amies_user DROP FOREIGN KEY FK_FD8B9739DA1E796');
        $this->addSql('CREATE TABLE amis (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, amis_id INT DEFAULT NULL, INDEX IDX_9FE2E761A76ED395 (user_id), INDEX IDX_9FE2E761706F82C7 (amis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amis ADD CONSTRAINT FK_9FE2E761A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE amis ADD CONSTRAINT FK_9FE2E761706F82C7 FOREIGN KEY (amis_id) REFERENCES fos_user (id)');
        $this->addSql('DROP TABLE amies');
        $this->addSql('DROP TABLE amies_user');
        $this->addSql('ALTER TABLE objet CHANGE user_id user_id INT DEFAULT NULL, CHANGE created_by_id created_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(500) DEFAULT NULL, CHANGE namephoto namephoto VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE echange CHANGE user_vendeur_id user_vendeur_id INT DEFAULT NULL, CHANGE user_acheteur_id user_acheteur_id INT DEFAULT NULL, CHANGE object_vendeur_id object_vendeur_id INT DEFAULT NULL, CHANGE object_achteur_id object_achteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE namephoto namephoto VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amies (id INT AUTO_INCREMENT NOT NULL, statue INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE amies_user (amies_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FD8B9739A76ED395 (user_id), INDEX IDX_FD8B9739DA1E796 (amies_id), PRIMARY KEY(amies_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE amies_user ADD CONSTRAINT FK_FD8B9739A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE amies_user ADD CONSTRAINT FK_FD8B9739DA1E796 FOREIGN KEY (amies_id) REFERENCES amies (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE amis');
        $this->addSql('ALTER TABLE echange CHANGE user_vendeur_id user_vendeur_id INT DEFAULT NULL, CHANGE user_acheteur_id user_acheteur_id INT DEFAULT NULL, CHANGE object_vendeur_id object_vendeur_id INT DEFAULT NULL, CHANGE object_achteur_id object_achteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE namephoto namephoto VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE objet CHANGE user_id user_id INT DEFAULT NULL, CHANGE created_by_id created_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE namephoto namephoto VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
