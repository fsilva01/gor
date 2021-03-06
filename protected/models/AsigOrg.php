<?php

/**
 * This is the model class for table "cnx_asig_org".
 *
 * The followings are the available columns in table 'cnx_asig_org':
 * @property integer $id_asig_org
 * @property integer $co_asig_org
 * @property integer $nu_docm_idnt
 * @property integer $co_org
 * @property string $fe_crea
 * @property string $fe_modf
 * @property string $usr_crea
 * @property string $usr_modf
 * @property string $in_stat
 * @property string $tx_desc
 *
 * The followings are the available model relations:
 * @property Org $coOrg
 * @property Usuarios $nuDocmIdnt
 */
class AsigOrg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cnx_asig_org';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('co_asig_org, nu_docm_idnt, co_org', 'required'),
			array('co_asig_org, nu_docm_idnt, co_org', 'numerical', 'integerOnly'=>true),
			array('usr_crea, usr_modf', 'length', 'max'=>10),
			array('in_stat', 'length', 'max'=>1),
			array('tx_desc', 'length', 'max'=>100),
			array('fe_crea, fe_modf', 'safe'),
                    
                        //Valida foreing key
                        array('nu_docm_idnt', 'exist',
                                'allowEmpty' => true,
                                'attributeName' => 'nu_docm_idnt',
                                'className' => 'Empleados',
                                'message' => 'El número de cédula no existe',
                                'skipOnError'=>true
                                ),
                        array('co_org', 'exist',
                                'allowEmpty' => true,
                                'attributeName' => 'co_org',
                                'className' => 'Org',
                                'message' => 'La Organización no existe',
                                'skipOnError'=>true
                                ),
                    
                    
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_asig_org, co_asig_org, nu_docm_idnt, co_org, fe_crea, fe_modf, usr_crea, usr_modf, in_stat, tx_desc', 'safe', 'on'=>'search'),
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
			'coOrg' => array(self::BELONGS_TO, 'Org', 'co_org'),
			'nuDocmIdnt' => array(self::BELONGS_TO, 'Empleados', 'nu_docm_idnt'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_asig_org' => 'Id Asig Org',
			'co_asig_org' => 'Codigo de registro',
			'nu_docm_idnt' => 'Cédula',
			'co_org' => 'Organización',
			'fe_crea' => 'Fe Crea',
			'fe_modf' => 'Fe Modf',
			'usr_crea' => 'Usr Crea',
			'usr_modf' => 'Usr Modf',
			'in_stat' => 'In Stat',
			'tx_desc' => 'Tx Desc',
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

		$criteria->compare('id_asig_org',$this->id_asig_org);
		$criteria->compare('co_asig_org',$this->co_asig_org);
		$criteria->compare('nu_docm_idnt',$this->nu_docm_idnt);
		$criteria->compare('co_org',$this->co_org);
		$criteria->compare('fe_crea',$this->fe_crea,true);
		$criteria->compare('fe_modf',$this->fe_modf,true);
		$criteria->compare('usr_crea',$this->usr_crea,true);
		$criteria->compare('usr_modf',$this->usr_modf,true);
		$criteria->compare('in_stat',$this->in_stat,true);
		$criteria->compare('tx_desc',$this->tx_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AsigOrg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
                            'class' => 'zii.behaviors.CTimestampBehavior',
                            'createAttribute' => 'fe_crea',
                            'updateAttribute' => 'fe_modf',
                            'setUpdateOnCreate' => true,
			),

			'BlameableBehavior' => array(
                            'class' => 'application.components.BlameableBehavior',
                            'createdByColumn' => 'usr_crea',
                            'updatedByColumn' => 'usr_modf',
			),
                    
                        'ActiveRecordLogableBehavior' => 'application.components.ActiveRecordLogableBehavior',
		);
	}
}
