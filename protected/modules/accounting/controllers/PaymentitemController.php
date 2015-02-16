<?php

class PaymentitemController extends Controller
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
		/*return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);*/
		return array('rights');
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Paymentitem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_GET['id']))
		{
			$orderOfPaymentId = $_GET['id'];
			$orderOfPayment = Orderofpayment::model()->findByPk($orderOfPaymentId); 
		}	
		
		if(isset($_POST['Paymentitem']))
		{
			$model->attributes=$_POST['Paymentitem'];
			$model->orderofpayment_id=$orderOfPaymentId;
			if($model->save()){
				if (Yii::app()->request->isAjaxRequest)
                {
                    $receipt=Receipt::model()->findByPk($receiptId);
					$totalCollection=$receipt->totalCollection;
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Collection successfully added",
						'totalCollection'=>Yii::app()->format->formatNumber($totalCollection)
                        ));
                    exit;               
                }
                else
                    $this->redirect(array('view','id'=>$model->id));
			}
		}
		
		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_form', array(
                	'model'=>$model, 
                	'orderOfPaymentId'=>$orderOfPaymentId, 
                	'orderOfPayment'=>$orderOfPayment
            ),true , true)));
            exit;               
        }else{
            $this->render('create',array('model'=>$model,));
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=NULL)
	{
		if(isset($_POST['Paymentitem']['id'])){
			$id=$_POST['Paymentitem']['id'];
		}else{
			if(isset($_POST['id']))
			$id=$_POST['id'];
		}
		
		$model=$this->loadModel($id);

		$orderOfPaymentId=$model->orderofpayment_id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Paymentitem']))
		{
			$model->attributes=$_POST['Paymentitem'];
			
			$model->orderofpayment_id=$orderOfPaymentId;
			//$model->receiptid=$receipt->receiptId;
			
			if($model->save()){
				if (Yii::app()->request->isAjaxRequest)
				{
					echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"Payment Item updated"
                        ));
                      
                    exit;    
				}
				else
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		if (Yii::app()->request->isAjaxRequest)
        {
			echo CJSON::encode(array(
                'status'=>'failure',
                'div'=>$this->renderPartial('_form', array(
                		'model'=>$model, 
                		'orderOfPaymentId'=>$orderOfPaymentId,
				), true, true)));
			
            exit;               
        }else{
			$this->render('update',array('model'=>$model,'receiptId'=>$receiptId));
        }
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
		$dataProvider=new CActiveDataProvider('Paymentitem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Paymentitem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paymentitem']))
			$model->attributes=$_GET['Paymentitem'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Paymentitem the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Paymentitem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Paymentitem $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='paymentitem-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSearchRequest()
	{
	    //$list = Request::model()->findAll('requestRefNum like :requestRefNum',array(':requestRefNum'=>"%".$_GET['q']."%"));
	    /*$list = Request::model()->findAll('requestRefNum like :requestRefNum AND rstl_id = :rstl_id',array(':requestRefNum'=>"%".$_GET['q']."%", ':rstl_id'=>$this->getRstlId()));
	    $result = array();
	    foreach ($list as $item){
	        $result[] = array(
	                'id'=>$item->id,
	                'text'=>$item->requestRefNum,
	        		'total'=>$item->getBalance(),
	        		//'total'=>1000,
	        );
	    }
	    echo CJSON::encode($result);*/
		
		if(isset($_POST['Paymentitem']['details'])){
			$requestRefNum=$_POST['Paymentitem']['details'];
			$criteria=new CDbCriteria;
			$criteria->select='id,requestRefNum,labId,total';
			$criteria->condition='rstl_id = :rstl_id AND requestRefNum=:requestRefNum AND t.cancelled=0';
			$criteria->params=array(
								':rstl_id'=>Yii::app()->Controller->getRstlId(),
								':requestRefNum'=>$requestRefNum
								);
			$request=Request::model()->find($criteria);
			if($request){
				$balance=$request->getBalance();
				if($balance==0)//during update
					$balance=$request->total;
					
				$requestArray=array(
					'id'=>$request->id,
					'requestRefNum'=>$request->requestRefNum,
					'labId'=>$request->labId,
					'balance'=>$balance
				);
			}
		}
		
		echo CJSON::encode($requestArray);
	    exit;
	}
}
