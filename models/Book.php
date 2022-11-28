<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $category
 * @property string|null $title
 * @property string|null $author
 * @property string|null $publisher
 * @property string|null $isbn
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
            [['category', 'title', 'author', 'publisher'], 'string'],
            [['price'], 'integer'],
            [['code', 'isbn', 'year', 'size', 'page'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'category' => 'Category',
            'title' => 'Title',
            'author' => 'Author',
            'publisher' => 'Publisher',
            'isbn' => 'Isbn',
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
