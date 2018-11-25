<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181114180839 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, name_id INT NOT NULL, workout_id INT DEFAULT NULL, reps INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_AEDAD51C71179CD6 (name_id), INDEX IDX_AEDAD51CA6CCCFC9 (workout_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT NOT NULL, image_id INT DEFAULT NULL, user_id INT NOT NULL, name VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, category VARCHAR(80) NOT NULL, slug VARCHAR(100) NOT NULL, published_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_649FFB72989D9B62 (slug), INDEX IDX_649FFB72FCFA9DAE (difficulty_id), INDEX IDX_649FFB723DA5256D (image_id), INDEX IDX_649FFB72A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT NOT NULL, image_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(100) NOT NULL, published_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_92ED7784989D9B62 (slug), INDEX IDX_92ED7784FCFA9DAE (difficulty_id), INDEX IDX_92ED77843DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_workout (program_id INT NOT NULL, workout_id INT NOT NULL, INDEX IDX_EF7503A63EB8070A (program_id), INDEX IDX_EF7503A6A6CCCFC9 (workout_id), PRIMARY KEY(program_id, workout_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, src VARCHAR(80) NOT NULL, alt VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, level VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercises_list (id INT AUTO_INCREMENT NOT NULL, exercise VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, difficulty INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4CB5BA8C989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C71179CD6 FOREIGN KEY (name_id) REFERENCES exercises_list (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CA6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workout (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB723DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE workout ADD CONSTRAINT FK_649FFB72A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED77843DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE program_workout ADD CONSTRAINT FK_EF7503A63EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_workout ADD CONSTRAINT FK_EF7503A6A6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workout (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB72A76ED395');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CA6CCCFC9');
        $this->addSql('ALTER TABLE program_workout DROP FOREIGN KEY FK_EF7503A6A6CCCFC9');
        $this->addSql('ALTER TABLE program_workout DROP FOREIGN KEY FK_EF7503A63EB8070A');
        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB723DA5256D');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED77843DA5256D');
        $this->addSql('ALTER TABLE workout DROP FOREIGN KEY FK_649FFB72FCFA9DAE');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784FCFA9DAE');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C71179CD6');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE workout');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE program_workout');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE exercises_list');
    }
}
