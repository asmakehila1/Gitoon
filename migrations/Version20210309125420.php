<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309125420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE materiels (id INT AUTO_INCREMENT NOT NULL, nom_mat INT NOT NULL, prix_mat VARCHAR(255) NOT NULL, quantite DOUBLE PRECISION NOT NULL, duree_location VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', statu VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', photo_materiel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE centre CHANGE photo_centre photo_centre VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE id_client client_id INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_CE60640419EB6921 ON reclamation (client_id)');
        $this->addSql('ALTER TABLE reservation ADD materiels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A10E8B56 FOREIGN KEY (materiels_id) REFERENCES materiels (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A10E8B56 ON reservation (materiels_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A10E8B56');
        $this->addSql('DROP TABLE materiels');
        $this->addSql('ALTER TABLE centre CHANGE photo_centre photo_centre LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640419EB6921');
        $this->addSql('DROP INDEX IDX_CE60640419EB6921 ON reclamation');
        $this->addSql('ALTER TABLE reclamation CHANGE client_id id_client INT NOT NULL');
        $this->addSql('DROP INDEX IDX_42C84955A10E8B56 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP materiels_id');
    }
}
