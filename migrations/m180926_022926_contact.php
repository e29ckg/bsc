<?php

use yii\db\Migration;

/**
 * Class m180926_022926_contact
 */
class m180926_022926_contact extends Migration
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
 
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'sex' => $this->string(),
            'photo' => $this->string(),
            'dep' => $this->string(),
            'tel' => $this->string(),
            
            'email' => $this->string(),
            'address' => $this->string(),
            'comment' => $this->string(),
            'created_at' => $this->string(),
            'updated_at' => $this->string(),
        ], $tableOptions);

        $this->insert('contact', [
            'name' =>'ทดสอบ สกุลไทย','sex' => 'เพศ','photo' => '','dep' => 'ที่ปรึกษากฎหมาย',
            'tel' => '08-12345678','email' => 'e29ckg@gmail','address' => 'เลขที่บ้าบ','comment' => 'comment',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('profile');
        echo "m180926_022926_contact cannot be reverted.\n";
        
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180926_022926_contact cannot be reverted.\n";

        return false;
    }
    */
}
