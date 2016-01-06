<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public $image;
    public $date_start;
    public $date_end;

    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['date_create', 'date_update', 'date'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['preview'], 'string', 'max' => 150],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Автор',
            'name' => 'Название',
            'date_create' => 'Дата добавления',
            'date_update' => 'Date Update',
            'preview' => 'Превью',
            'date' => 'Дата выхода книги',
            'image' => 'Изображение превью',
            'date_start' => 'Дата выхода книги c',
            'date_end' => 'до',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if (!empty($this->date)){$this->date = date('Y-m-d H:i:s', strtotime($this->date)); }


            if ($this->isNewRecord){
                $this->date_create = date('Y-m-d H:i:s');
            }
            $this->date_update = date('Y-m-d H:i:s');

            return true;
        }
        return false;
    }

    public static function returnDate($date){
        $months = [
            'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'иля', 'августа', 'сентября', 'октября', 'ноября', 'дкабря'
        ];


        $s_dt = substr($date,0,10);
        $num_days = ceil((strtotime($s_dt)-time())/86400);
        switch ($num_days) {
            case 0:
                $return_date = 'Сегодня';
                break;
            case 1:
                $return_date = 'Завтра';
                break;
            case 2:
                $return_date = 'После завтра';
                break;
            case -1:
                $return_date = 'Вчера';
                break;
            case -2:
                $return_date = 'Позавчера';
                break;
            default:
                $return_date = date('d', strtotime($date)).' '.($months[ date( "n" ) - 1 ]).' '.date('Y', strtotime($date));
        }


        return $return_date;
    }
}
