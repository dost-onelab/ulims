<div class="cancelled"></div>
<div class="img-cancelled">
<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/cancelled.png','Cancelled');?>
<div class="alert alert-danger" style="width:400px; margin:0 auto; opacity:.8">
<table class="table table-condensed">
<tr><th style="width:180px">Reason of Cancellation:</th><td><?php echo $model->reason;?></td></tr>
<tr><th>Date Cancelled:</th><td><?php echo $model->cancelDate;?></td></tr>
<tr><th>Cancelled by:</th><td><?php echo Users::model()->findByPk($model->cancelledBy)->getFullname();?></td></tr>
</table>
</div>
</div>