<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302235908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE centre (id INT AUTO_INCREMENT NOT NULL, id_centre INT NOT NULL, nom_centre VARCHAR(255) NOT NULL, owner VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, description_centre VARCHAR(2000) NOT NULL, prix_centre DOUBLE PRECISION NOT NULL, photo_centre LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, id_reclamation INT NOT NULL, id_client INT NOT NULL, type_reclamation VARCHAR(255) NOT NULL, objet_reclamation VARCHAR(255) NOT NULL, image_reclamation LONGBLOB DEFAULT NULL, description_reclamation VARCHAR(1500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, id_reservation INT NOT NULL, id_client INT NOT NULL, id_centre INT NOT NULL, id_materiel INT NOT NULL, id_evenement INT NOT NULL, id_promotion INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE centre');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation');
    }
}
