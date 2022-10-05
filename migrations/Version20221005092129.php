<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005092129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transaction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, id_user_id INT NOT NULL, balance NUMERIC(10, 2) NOT NULL, iban VARCHAR(34) NOT NULL, account_state BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7D3656A479F37AE5 ON account (id_user_id)');
        $this->addSql('CREATE TABLE transaction (id INT NOT NULL, id_sender_id INT DEFAULT NULL, id_receiver_id INT DEFAULT NULL, date DATE NOT NULL, reason VARCHAR(150) DEFAULT NULL, amount NUMERIC(10, 2) NOT NULL, transaction_state BOOLEAN NOT NULL, deposit_identity VARCHAR(50) DEFAULT NULL, type VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_723705D176110FBA ON transaction (id_sender_id)');
        $this->addSql('CREATE INDEX IDX_723705D1D5412041 ON transaction (id_receiver_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, date_of_birth DATE NOT NULL, phone VARCHAR(10) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A479F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D176110FBA FOREIGN KEY (id_sender_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1D5412041 FOREIGN KEY (id_receiver_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE transaction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE account DROP CONSTRAINT FK_7D3656A479F37AE5');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D176110FBA');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D1D5412041');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE "user"');
    }
}
