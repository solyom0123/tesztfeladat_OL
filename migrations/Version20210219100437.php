<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219100437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE worker (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birtdate DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE working_time (id INT AUTO_INCREMENT NOT NULL, worker_id_id INT NOT NULL, date DATE NOT NULL, start TIME NOT NULL, end TIME NOT NULL, in_hour DOUBLE PRECISION NOT NULL, weekend_bonus DOUBLE PRECISION NOT NULL, INDEX IDX_31EE2ABF63E33A83 (worker_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE working_time ADD CONSTRAINT FK_31EE2ABF63E33A83 FOREIGN KEY (worker_id_id) REFERENCES worker (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE working_time DROP FOREIGN KEY FK_31EE2ABF63E33A83');
        $this->addSql('DROP TABLE worker');
        $this->addSql('DROP TABLE working_time');
    }
}
