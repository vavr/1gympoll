<?php

/**
 * This is the model class for table "poll".
 *
 * The followings are the available columns in table 'poll':
 * @property integer $id
 * @property string $hash
 * @property string $name
 * @property string $untill_date
 * @property integer $is_ended
 * @property PollResult[] $results
 */
class Poll extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'poll';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hash, name, untill_date, is_ended', 'required'),
			array('is_ended', 'numerical', 'integerOnly'=>true),
			array('hash, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hash, name, untill_date, is_ended', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'results'=>array(self::HAS_MANY, 'PollResult', 'poll_id', 'order'=>'upd_time ASC'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hash' => 'Hash',
			'name' => 'Name',
			'untill_date' => 'Untill Date',
			'is_ended' => 'Is Ended',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('untill_date',$this->untill_date,true);
		$criteria->compare('is_ended',$this->is_ended);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Poll the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function isActive()
    {
        if ($this->is_ended) {
            return false;
        }

        if ($this->untill_date < date('Y-m-d H:i:s')) {
            return false;
        }

        return true;
    }
}
