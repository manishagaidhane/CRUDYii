<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form" id = "customers-form_add">
    <?php yii\widgets\Pjax::begin(['id' => 'new_customer']) ?>

    <?php 
        $form = ActiveForm::begin([
            'options' => ['data-pjax' => true ],
            'layout' => 'inline',
            'fieldConfig' => [
                'labelOptions' =>['class' => ''],
                'enableError' => true,
            ],
        ]); 

    ?>
    <div class="form-group ">
            <?= $form->field($model, 'name')->textInput()->input('name',  [ 'label' => 'Full Name : ', 'placeholder' => "Enter Your Name", 'maxlength' => true, 'style'=>'width:200px']) ?>
 
            <?= $form->field($model, 'email')->textInput()->input('email', ['placeholder' => "Enter Your Email", 'maxlength' => true, 'style'=>'width:200px']) ?>

            <?= $form->field($model, 'phone_number')->textInput()->input('phone_number', ['placeholder' => "Enter Your Phone", 'maxlength' => true,'style'=>'width:200']) ?>

          
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success form-cust-btn-group' : 'btn btn-primary form-cust-btn-group']) ?>


        </div>

    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>

</div>



<?php

$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_customer").on("pjax:end", function() {
            $.pjax.reload({container:"#customers_pjax"});  //Reload GridView
        });
    });'
);
?>
