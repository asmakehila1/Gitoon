<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331193923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion ADD prix_ancien VARCHAR(255) NOT NULL, ADD prix_nv VARCHAR(255) NOT NULL, CHANGE image_promo image_promo VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE publicite CHANGE image_pub image_pub VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion DROP prix_ancien, DROP prix_nv, CHANGE image_promo image_promo LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE publicite CHANGE image_pub image_pub LONGBLOB NOT NULL');
    }
}
