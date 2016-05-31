<div class="action">
    <?php echo CHtml::link('<i>&#xf055;</i>Thêm', array('create')); ?>
    <?php echo CHtml::ajaxLink("<i>&#xf014;</i>Xóa chọn", array('deletes'), array(
        "type"    => "post",
        "data"    => "js:{ids:$.fn.yiiGridView.getChecked('data-grid','ids')}",
        "success" => "function(data){
            $.fn.yiiGridView.update('data-grid'); 
        }"),
        array('confirm' => 'Bạn có chắc chắn muốn xóa?')); 
    ?>
</div>
<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'data-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions'=>array('class'=>'table tbuser'),
	'summaryText'=>'',
	'filter'=>$model,
	'afterAjaxUpdate'=>'function(id, data){
		$("#data-grid").append("<script src=\"'.Yii::app()->controller->module->assetsUrl.'/js/status.js\"><\/script>");
		$("#data-grid").append("<script src=\"'.Yii::app()->controller->module->assetsUrl.'/js/ordering.js\"><\/script>");
		$("#data-grid").append("<script src=\"'.Yii::app()->controller->module->assetsUrl.'/js/detail.js\"><\/script>");
	}',
	'columns'=>array(
		array(
			'name'=>'id',
			'htmlOptions'=>array('class'=>'ct mini'),
            'filterHtmlOptions'=>array('class'=>'mini'),
		),
		array(
			'name'=>'title',
		),
		array(
			'name'=>'content',
            'value'=>'$data->config_type==1?$data->content:($data->config_type==2?(mb_substr(strip_tags($data->html_content),0,500,"utf-8")):($data->config_type==3?CHtml::image(Yii::app()->baseUrl."/data/images/config/".$data->image,$data->title, array("style"=>"height: 100px;display: block; margin: 0 auto;")):"???"))',
			'header'=>'Nội Dung',
			'type'=>'raw',
            'htmlOptions'=>array('style'=>'max-width: 400px;'),
		),
		array(
			'name'=>'config_type',
			'value'=>'isset(Yii::app()->params["configs.type"][$data->config_type]) ? Yii::app()->params["configs.type"][$data->config_type] : "Unknown"',   
		),
		array(
			'name'=>'updated',
			'value'=>'date("d-m-Y H:i:s", strtotime($data->updated))',
			'htmlOptions'=>array('class'=>'ct'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>Yii::app()->user->role==='admin'?'{update}{delete}':'{update}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['recordsPerPage'],array(
						  'onchange'=>"$.fn.yiiGridView.update('data-grid',{data:{pageSize: $(this).val()}})")),
			'htmlOptions'=>array('class'=>'ct act'),
			'buttons'=>array (
				'update' => array(
					'label'=>'<i>&#xf040;</i>',
					'options'=>array('title'=>'Cập Nhật'),
					'imageUrl'=>false,
				),
				'delete' => array(
					'label'=>'<i>&#xf014;</i>',
					'options'=>array('title'=>'Xóa'),
					'imageUrl'=>false,
				),
			),
		),
	),
	'pager'=>array(
		'cssFile'=>false,
		'class'=>'CLinkPager',
		'pageSize'=>Yii::app()->params['defaultPageSize'],
		'firstPageLabel' => 'First',
		'prevPageLabel' => 'Previous',
		'nextPageLabel' => 'Next',
		'lastPageLabel' => 'Last',
		'header'=>'',
		'selectedPageCssClass'=>'active',
	),
	'pagerCssClass' => 'pagination',
)); ?>