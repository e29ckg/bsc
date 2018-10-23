<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $user_id
 * @property string $fname
 * @property string $name
 * @property string $sname
 * @property string $photo
 * @property string $birthday
 * @property int $idc
 * @property string $dep
 * @property string $address
 * @property string $tel
 * @property int $created_at
 * @property int $updated_at
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'fname', 'name', 'created_at', 'updated_at'], 'required'],
            [['birthday'], 'safe'],
            [['idc', 'created_at', 'updated_at'], 'integer'],
            [['user_id', 'photo', 'dep', 'address', 'tel'], 'string', 'max' => 255],
            [['fname'], 'string', 'max' => 25],
            [['name', 'sname'], 'string', 'max' => 50],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'fname' => 'Fname',
            'name' => 'Name',
            'sname' => 'Sname',
            'photo' => 'Photo',
            'birthday' => 'Birthday',
            'idc' => 'Idc',
            'dep' => 'Dep',
            'address' => 'Address',
            'tel' => 'Tel',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
