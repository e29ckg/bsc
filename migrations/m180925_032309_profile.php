<?php

use yii\db\Migration;

/**
 * Class m180925_032309_profile
 */
class m180925_032309_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
 
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
 
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string()->notNull()->unique(),
            'fname' => $this->string(25)->notNull(),
            'name' => $this->string(50)->notNull(),
            'sname' => $this->string(50),
            'photo' => $this->string(),
            'birthday' => $this->date(),
            'idc' => $this->smallInteger(),
            'dep' => $this->string(),
            'address' => $this->string(),
            'tel' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('profile', [
            'user_id' => '1','fname' => 'นาย','name' => 'Admin','sname' => 'S-Admin','created_at' => '1','updated_at' => '1',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('profile');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180925_032309_profile cannot be reverted.\n";

        return false;
    }
    */
}
