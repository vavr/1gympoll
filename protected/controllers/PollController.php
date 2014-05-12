<?php

class PollController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view', 'vote'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);

        $this->render('view',array(
			'model'=>$model
		));
	}

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionVote($id, $hash = null)
    {
        Yii::app()->poll;

        /**
         * @var PollUser $user
         */
        if ($hash === null) {
            $user = Yii::app()->session->get('currentPollUser');
        } else {
            $user = Yii::app()->poll->getUserFromHash($id, $hash);
            Yii::app()->session->add('currentPollUser', $user);
        }

        if (!$user) {
            throw new PollException('Неизвестный пользователь голосования. Перейдите по индивидуальной ссылке присланной Вам по почте в группу или обратитесь к администратору '.Yii::app()->params['adminEmail']);
        }

        $poll = $this->loadModel($id);

        if (!$poll) {
            throw new CHttpException(404, 'Голосование не найдено');
        }

        if (!$poll->isActive()) {
            $this->redirect(array('poll/view', 'id' => $id));
        }

        if (Yii::app()->request->getParam('vote')) {

            $pollResult = PollResult::model()->findByAttributes(array('poll_id' => $poll->id, 'user_id' => $user->id));
            if (!$pollResult) {
                $pollResult = new PollResult();
                $pollResult->user_id = $user->id;
                $pollResult->poll_id = $poll->id;
            }

            $pollResult->upd_time = new CDbExpression('NOW()');

            $submited = Yii::app()->request->getParam('vote');
            unset($submited['submit']);

            $pollResult->results = json_encode($submited);

            if (!$pollResult->save()) {
                throw new PollException('Не удалось сохранить результат голосования. Обратитесь к админимтратору '.Yii::app()->params['adminEmail']);
            }

            $this->render('voted',array(
                'poll' => $poll,
                'user' => $user
            ));
        } else {
            $this->render('vote',array(
                'poll' => $poll,
                'user' => $user
            ));
        }
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Poll;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Poll']))
		{
			$model->attributes=$_POST['Poll'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Poll']))
		{
			$model->attributes=$_POST['Poll'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Poll');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Poll('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Poll']))
			$model->attributes=$_GET['Poll'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Poll the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Poll::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Запрашиваемое глосование не найденно.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Poll $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='poll-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionInvite()
    {
        $info = array();
        $request = Yii::app()->request;
        if ($request->getPost('invite')) {

            if (!$request->getPost('pollId')) {
                throw new CHttpException(400, 'Выбирете голосование');
            }

            $info = Yii::app()->poll->sendInvitesToPoll($request->getPost('pollId'), $request->getPost('message'));
        }

        $polls = Poll::model()->findAll('is_ended = 0 AND untill_date > :now', array(':now' => date('Y-m-d H:i:s')));

        $this->render('invite',array(
            'info' => $info,
            'polls' => $polls,
            'message' => $request->getPost('message'),
        ));
    }
}
