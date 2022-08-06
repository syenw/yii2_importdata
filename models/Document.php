<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $size
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'size' => 'Size',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DocumentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentQuery(get_called_class());
    }
}
