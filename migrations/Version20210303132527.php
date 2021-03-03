<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303132527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adoption (id INT AUTO_INCREMENT NOT NULL, poulet_id INT NOT NULL, famille_id INT NOT NULL, montant_mensuel DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_EDDEB6A9F2888615 (poulet_id), INDEX IDX_EDDEB6A997A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adoption ADD CONSTRAINT FK_EDDEB6A9F2888615 FOREIGN KEY (poulet_id) REFERENCES poulet (id)');
        $this->addSql('ALTER TABLE adoption ADD CONSTRAINT FK_EDDEB6A997A77B84 FOREIGN KEY (famille_id) REFERENCES parent (id)');
        $this->addSql('ALTER TABLE parent DROP montant_mensuel');
        $this->addSql('ALTER TABLE poulet DROP FOREIGN KEY fk_parent_id');
        $this->addSql('DROP INDEX fk_parent_id ON poulet');
        $this->addSql('ALTER TABLE poulet DROP id_parent, CHANGE id_fermier id_fermier INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE adoption');
        $this->addSql('ALTER TABLE parent ADD montant_mensuel INT NOT NULL');
        $this->addSql('ALTER TABLE poulet ADD id_parent INT DEFAULT NULL, CHANGE id_fermier id_fermier INT NOT NULL');
        $this->addSql('ALTER TABLE poulet ADD CONSTRAINT fk_parent_id FOREIGN KEY (id_parent) REFERENCES parent (id)');
        $this->addSql('CREATE INDEX fk_parent_id ON poulet (id_parent)');
    }
}
