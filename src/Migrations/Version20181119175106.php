<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181119175106 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB72FCFA9DAE');
        $this->addSql('DROP INDEX IDX_649FFB72FCFA9DAE ON workout');
        $this->addSql('ALTER TABLE workout DROP difficulty_id, DROP category');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE workout ADD difficulty_id INT NOT NULL, ADD category VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('CREATE INDEX IDX_649FFB72FCFA9DAE ON workout (difficulty_id)');
    }
}
