<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110082422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE averia ADD poliza_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE averia ADD CONSTRAINT FK_D1FF521CD5746945 FOREIGN KEY (poliza_id) REFERENCES poliza (id)');
        $this->addSql('CREATE INDEX IDX_D1FF521CD5746945 ON averia (poliza_id)');
        $this->addSql('ALTER TABLE poliza ADD aseguradora_id INT NOT NULL, ADD inmueble_id INT DEFAULT NULL, ADD asegurado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poliza ADD CONSTRAINT FK_78113458C3EE7049 FOREIGN KEY (aseguradora_id) REFERENCES aseguradora (id)');
        $this->addSql('ALTER TABLE poliza ADD CONSTRAINT FK_78113458932498D9 FOREIGN KEY (inmueble_id) REFERENCES inmueble (id)');
        $this->addSql('ALTER TABLE poliza ADD CONSTRAINT FK_781134586A365950 FOREIGN KEY (asegurado_id) REFERENCES asegurado (id)');
        $this->addSql('CREATE INDEX IDX_78113458C3EE7049 ON poliza (aseguradora_id)');
        $this->addSql('CREATE INDEX IDX_78113458932498D9 ON poliza (inmueble_id)');
        $this->addSql('CREATE INDEX IDX_781134586A365950 ON poliza (asegurado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE averia DROP FOREIGN KEY FK_D1FF521CD5746945');
        $this->addSql('DROP INDEX IDX_D1FF521CD5746945 ON averia');
        $this->addSql('ALTER TABLE averia DROP poliza_id');
        $this->addSql('ALTER TABLE poliza DROP FOREIGN KEY FK_78113458C3EE7049');
        $this->addSql('ALTER TABLE poliza DROP FOREIGN KEY FK_78113458932498D9');
        $this->addSql('ALTER TABLE poliza DROP FOREIGN KEY FK_781134586A365950');
        $this->addSql('DROP INDEX IDX_78113458C3EE7049 ON poliza');
        $this->addSql('DROP INDEX IDX_78113458932498D9 ON poliza');
        $this->addSql('DROP INDEX IDX_781134586A365950 ON poliza');
        $this->addSql('ALTER TABLE poliza DROP aseguradora_id, DROP inmueble_id, DROP asegurado_id');
    }
}
