<?php

use yii\db\Migration;

/**
 * Class m181024_022926_idp
 */
class m181024_022926_idp extends Migration
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
 
        $this->createTable('idp_proj', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            // 'date_idp' => $this->dateTime(),
            'date_idp' => $this->string(),
            'num' => $this->string(),
            'comment' => $this->string(),
            'created_at' => $this->string(),
            'updated_at' => $this->string(),
        ], $tableOptions);

        $this->createTable('idp_file', [
            'id_file' => $this->primaryKey(),
            'name_file' => $this->string(50)->notNull()->unique(),
            'file_path' => $this->dateTime(),
            'created_at' => $this->string(),
            'updated_at' => $this->string(),
        ], $tableOptions);

        $this->insert('idp_proj', [
            'name' =>'ทดสอบ โครงการ','date_idp' => '','num' => '','created_at' => '',
            'updated_at' => time(),
        ]);

        $this->insert('idp_file', [
            'name_file' =>'ทดสอบ ชื่อfile','file_path' => 'c:\127.0.0.1\x.x','created_at' => '',
            'updated_at' => '',
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
