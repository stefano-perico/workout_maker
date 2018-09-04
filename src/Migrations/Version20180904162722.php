<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180904162722 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE program_workout (program_id INT NOT NULL, workout_id INT NOT NULL, INDEX IDX_EF7503A63EB8070A (program_id), INDEX IDX_EF7503A6A6CCCFC9 (workout_id), PRIMARY KEY(program_id, workout_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout_exercice (workout_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_3C692AFBA6CCCFC9 (workout_id), INDEX IDX_3C692AFB89D40298 (exercice_id), PRIMARY KEY(workout_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE program_workout ADD CONSTRAINT FK_EF7503A63EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_workout ADD CONSTRAINT FK_EF7503A6A6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workout_exercice ADD CONSTRAINT FK_3C692AFBA6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workout_exercice ADD CONSTRAINT FK_3C692AFB89D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program ADD difficulty_id INT NOT NULL, ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED77843DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_92ED7784FCFA9DAE ON program (difficulty_id)');
        $this->addSql('CREATE INDEX IDX_92ED77843DA5256D ON program (image_id)');
        $this->addSql('ALTER TABLE exercice ADD difficulty_id INT NOT NULL, ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DFCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_E418C74DFCFA9DAE ON exercice (difficulty_id)');
        $this->addSql('CREATE INDEX IDX_E418C74D3DA5256D ON exercice (image_id)');
        $this->addSql('ALTER TABLE workout ADD difficulty_id INT NOT NULL, ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB723DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_649FFB72FCFA9DAE ON workout (difficulty_id)');
        $this->addSql('CREATE INDEX IDX_649FFB723DA5256D ON workout (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE program_workout');
        $this->addSql('DROP TABLE workout_exercice');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DFCFA9DAE');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74D3DA5256D');
        $this->addSql('DROP INDEX IDX_E418C74DFCFA9DAE ON exercice');
        $this->addSql('DROP INDEX IDX_E418C74D3DA5256D ON exercice');
        $this->addSql('ALTER TABLE exercice DROP difficulty_id, DROP image_id');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784FCFA9DAE');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED77843DA5256D');
        $this->addSql('DROP INDEX IDX_92ED7784FCFA9DAE ON program');
        $this->addSql('DROP INDEX IDX_92ED77843DA5256D ON program');
        $this->addSql('ALTER TABLE program DROP difficulty_id, DROP image_id');
        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB72FCFA9DAE');
        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB723DA5256D');
        $this->addSql('DROP INDEX IDX_649FFB72FCFA9DAE ON workout');
        $this->addSql('DROP INDEX IDX_649FFB723DA5256D ON workout');
        $this->addSql('ALTER TABLE workout DROP difficulty_id, DROP image_id');
    }
}
