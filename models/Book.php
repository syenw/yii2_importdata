<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $category
 * @property string|null $code
 * @property string|null $title
 * @property string|null $author
 * @property string|null $publisher
 * @property string|null $year
 * @property string|null $size
 * @property string|null $page
 * @property int|null $price
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'title', 'author'], 'string'],
            [['price'], 'integer'],
            [['category', 'publisher', 'year', 'size', 'page'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'code' => 'Code',
            'title' => 'Title',
            'author' => 'Author',
            'publisher' => 'Publisher',
            'year' => 'Year',
            'size' => 'Size',
            'page' => 'Page',
            'price' => 'Price',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }
}
