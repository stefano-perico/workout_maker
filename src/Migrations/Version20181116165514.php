<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181116165514 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C71179CD6');
        $this->addSql('DROP INDEX UNIQ_AEDAD51C71179CD6 ON exercise');
        $this->addSql('ALTER TABLE exercise CHANGE name_id exercise_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CAB026B93 FOREIGN KEY (exercise_name_id) REFERENCES exercises_list (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AEDAD51CAB026B93 ON exercise (exercise_name_id)');
        $this->addSql('ALTER TABLE exercises_list ADD published_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CAB026B93');
        $this->addSql('DROP INDEX UNIQ_AEDAD51CAB026B93 ON exercise');
        $this->addSql('ALTER TABLE exercise CHANGE exercise_name_id name_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C71179CD6 FOREIGN KEY (name_id) REFERENCES exercises_list (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AEDAD51C71179CD6 ON exercise (name_id)');
        $this->addSql('ALTER TABLE exercises_list DROP published_at');
    }
}
