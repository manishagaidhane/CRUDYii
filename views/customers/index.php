<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customers-index">

   
    
    <div class="customers-cust-form">
        <h3 id="mar-l">Contact Us:</h3>
         <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
<div class="customers-cust-form">
    <h3>Contact us List</h3></br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin([
    'id' => 'customers_pjax',
    "enablePushState" => false,

]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No',

            ],

           // 'id',
            'name',
            'email:email',
            'phone_number',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons'=>[

                    'update' => function($url, $model){
                        $ulink = Html::a('Edit', ['index', 'id' => $model->id], ['class' => 'btn btn-success', 'data' => [
                                'method' => 'post',
                            ],
                        ]);
                        return $ulink;
                    },

                    'delete' => function ($url, $model) {
                        return Html::a('<span class="btn btn-danger">Delete</span>', true, [
                            'class' => 'pjax-delete-link',
                            'delete-url' => $url,
                            'pjax-container' => 'customers_pjax',
                            'title' => Yii::t('yii', 'Delete')
                        ]);
                    }      
                ],
            ],
        ]
    ]);
?>
<?php Pjax::end() ?>

</div>

<?php
 $this->registerJs("

     $(document).on('ready pjax:success', function() {
         $('.pjax-delete-link').on('click', function(e) {
             e.preventDefault();
             var deleteUrl = $(this).attr('delete-url');
             var pjaxContainer = $(this).attr('pjax-container');
             var result = confirm('Are you sure you want to delete this record?');                                
             if(result) {
                 $.ajax({
                     url: deleteUrl,
                     type: 'post',
                     error: function(xhr, status, error) {
                         alert('There was an error with your request.' + xhr.responseText);
                     }
                 }).done(function(data) {
                     $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
                 });
             }
         });

     });
 ");
?>