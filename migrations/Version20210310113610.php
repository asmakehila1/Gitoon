<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310113610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion CHANGE id_promo id_promo INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_promo)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion MODIFY id_promo INT NOT NULL');
        $this->addSql('ALTER TABLE promotion DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE promotion CHANGE id_promo id_promo INT NOT NULL');
    }
}
