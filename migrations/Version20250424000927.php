<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424000927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE actuality (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE cycle_part (id INT AUTO_INCREMENT NOT NULL, caster_angle DOUBLE PRECISION DEFAULT NULL, caster DOUBLE PRECISION DEFAULT NULL, wheelbase DOUBLE PRECISION DEFAULT NULL, rim VARCHAR(255) DEFAULT NULL, frame VARCHAR(255) DEFAULT NULL, front_suspension VARCHAR(255) DEFAULT NULL, rear_suspension VARCHAR(255) DEFAULT NULL, front_brake VARCHAR(255) DEFAULT NULL, rear_brake VARCHAR(255) DEFAULT NULL, front_wheel VARCHAR(255) DEFAULT NULL, rear_wheel VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE dimension (id INT AUTO_INCREMENT NOT NULL, length INT DEFAULT NULL, width INT DEFAULT NULL, height INT DEFAULT NULL, saddle_height INT DEFAULT NULL, ground_clearance INT DEFAULT NULL, gas DOUBLE PRECISION DEFAULT NULL, oil DOUBLE PRECISION DEFAULT NULL, weight INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE engine (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, cylinders INT DEFAULT NULL, announced_power VARCHAR(150) DEFAULT NULL, couple_announced VARCHAR(150) DEFAULT NULL, power_supply VARCHAR(100) DEFAULT NULL, consumption VARCHAR(100) DEFAULT NULL, co2_emissions VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE information (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(50) NOT NULL, model VARCHAR(50) NOT NULL, category VARCHAR(50) NOT NULL, cylinders INT NOT NULL, price DOUBLE PRECISION NOT NULL, warranty_time INT NOT NULL, available_for_trial TINYINT(1) NOT NULL, license JSON NOT NULL COMMENT '(DC2Type:json)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender VARCHAR(255) DEFAULT NULL, object VARCHAR(255) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE message_image (id INT AUTO_INCREMENT NOT NULL, message_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_3A9BFBB4537A1329 (message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE new_vehicle (id INT AUTO_INCREMENT NOT NULL, cycle_part_id INT DEFAULT NULL, dimension_id INT DEFAULT NULL, engine_id INT DEFAULT NULL, information_id INT DEFAULT NULL, transmission_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_C0C3B7684C3EEEA3 (cycle_part_id), INDEX IDX_C0C3B768277428AD (dimension_id), INDEX IDX_C0C3B768E78C9C0A (engine_id), INDEX IDX_C0C3B7682EF03101 (information_id), INDEX IDX_C0C3B76878D28519 (transmission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE new_vehicle_image (id INT AUTO_INCREMENT NOT NULL, new_vehicle_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_FC126658896CF41D (new_vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE transmission (id INT AUTO_INCREMENT NOT NULL, final_transmission VARCHAR(255) DEFAULT NULL, clutch VARCHAR(255) DEFAULT NULL, command VARCHAR(255) DEFAULT NULL, gearbox VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE used_vehicle (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(50) NOT NULL, model VARCHAR(50) NOT NULL, category VARCHAR(50) NOT NULL, cylinders INT NOT NULL, price DOUBLE PRECISION NOT NULL, warranty_time INT NOT NULL, description LONGTEXT NOT NULL, available_for_trial TINYINT(1) NOT NULL, color VARCHAR(50) NOT NULL, year INT NOT NULL, kilometers INT NOT NULL, energy_tax INT NOT NULL, tax_power INT NOT NULL, power VARCHAR(100) NOT NULL, statue TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE used_vehicle_image (id INT AUTO_INCREMENT NOT NULL, used_vehicle_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_2F84625E10119921 (used_vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message_image ADD CONSTRAINT FK_3A9BFBB4537A1329 FOREIGN KEY (message_id) REFERENCES message (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle ADD CONSTRAINT FK_C0C3B7684C3EEEA3 FOREIGN KEY (cycle_part_id) REFERENCES cycle_part (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle ADD CONSTRAINT FK_C0C3B768277428AD FOREIGN KEY (dimension_id) REFERENCES dimension (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle ADD CONSTRAINT FK_C0C3B768E78C9C0A FOREIGN KEY (engine_id) REFERENCES engine (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle ADD CONSTRAINT FK_C0C3B7682EF03101 FOREIGN KEY (information_id) REFERENCES information (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle ADD CONSTRAINT FK_C0C3B76878D28519 FOREIGN KEY (transmission_id) REFERENCES transmission (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle_image ADD CONSTRAINT FK_FC126658896CF41D FOREIGN KEY (new_vehicle_id) REFERENCES new_vehicle (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE used_vehicle_image ADD CONSTRAINT FK_2F84625E10119921 FOREIGN KEY (used_vehicle_id) REFERENCES used_vehicle (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE message_image DROP FOREIGN KEY FK_3A9BFBB4537A1329
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle DROP FOREIGN KEY FK_C0C3B7684C3EEEA3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle DROP FOREIGN KEY FK_C0C3B768277428AD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle DROP FOREIGN KEY FK_C0C3B768E78C9C0A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle DROP FOREIGN KEY FK_C0C3B7682EF03101
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle DROP FOREIGN KEY FK_C0C3B76878D28519
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE new_vehicle_image DROP FOREIGN KEY FK_FC126658896CF41D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE used_vehicle_image DROP FOREIGN KEY FK_2F84625E10119921
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE actuality
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cycle_part
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE dimension
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE engine
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE information
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message_image
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE new_vehicle
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE new_vehicle_image
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE transmission
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE used_vehicle
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE used_vehicle_image
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
    }
}
