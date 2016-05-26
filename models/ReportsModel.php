<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property string $id
 * @property string $host
 * @property string $code
 * @property string $message
 * @property string $created
 */
class ReportsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['host', 'code', 'message'], 'required'],
            [['code'], 'integer'],
            [['message'], 'string'],
            [['created'], 'safe'],
            [['host'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'host' => Yii::t('app', 'Host'),
            'code' => Yii::t('app', 'Code'),
            'message' => Yii::t('app', 'Message'),
            'created' => Yii::t('app', 'Created'),
        ];
    }
}
