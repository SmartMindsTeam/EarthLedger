<?php

use humhub\modules\custom_post\Assets;
use humhub\modules\file\handler\FileHandlerCollection;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \yii\helpers\Html;

Assets::register($this);
$fileHandlerImport = FileHandlerCollection::getByType(FileHandlerCollection::TYPE_IMPORT);
$fileHandlerCreate = FileHandlerCollection::getByType(FileHandlerCollection::TYPE_CREATE);

$fileHandlers = array_merge($fileHandlerCreate, $fileHandlerImport);

?>
<div class="bg-panel">
  <div class="panel">
    <div class="panel-body">
      <div class="btn-row">
        <button id="btn_challenge" data-type="challenge" class="popup_btn">Challenge</button>
        <button id="btn_solution" data-type="solution" class="popup_btn">Solution</button>
        <button id="btn_product" data-type="product" class="popup_btn">Product</button>
        <button id="btn_news" data-type="news" class="popup_btn">News</button>
        <button id="btn_custom" data-type="custom" class="popup_btn">Custom</button>
      </div>
      <button id="dash_btn" data-toggle="modal" data-target="#customPostModal">What can you add to the network today?</button>
    </div>
  </div>
</div>


<div id="customPostModal" class="modal fade" role="dialog">
  <div id="modal-dialog_outer" class="modal-dialog modal-challenge">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 id="modal_heading">Post Challenge</h3>
        <small id="modal_descrptn">Thank you for contributing to the Earth Ledger Network. Tell us about your challenge below:</small>
      </div>
      <div class="modal-body">
        <?php
        $form = ActiveForm::begin(['id' => 'custom_post-sumitForm', 'method' => 'post', 'action' => ['/custom_post/site/save'], 'options' => ['enctype' => 'multipart/form-data']]);
        $model->type = 'challenge';
        ?>

        <?php //$form->field($model, 'type')->dropdownList(['challenge' => 'Challenge', 'solution' => 'Solution', 'news' => 'News', 'product' => 'Product', 'custom' => 'Custom']);?>

        <?=$form->field($model, 'type')->hiddenInput()->label(false)?>


        <div id="top_row_arrangement">
          <div id="top_column_1" class="displayNone product_fields">
            <?= $form->field($model, 'product_type')->dropdownList(['art-craft' => 'Art/Craft','beauty-and-personal-care' => 'Beauty And Personal Care', 'courses' => 'Courses','E-Books' => 'E-Books','fashion-wear' => 'Fashion Wear','food-and-beverages' => 'Food And Beverages','health' => 'Health','household' => 'Household','software' => 'Software','technology' => 'Technology'], ['prompt' => '---Select---']);?>
          </div>
          <div id="top_colum_2">
            <?=$form->field($model, 'stream')->dropdownList(['air' => 'Air', 'land' => 'Land', 'ocean' => 'Ocean', 'river' => 'River']);?>
          </div>
        </div>

        <div id="challenge_field">
            <?=$form->field($model, 'challenge_name')->textInput();?>
        </div>

        <div id="all_fields">

            <?=$form->field($model, 'description')->textArea(['rows' => '6'])?>

            <?=$form->field($model, 'location')->textInput();?>

          <label class="control-label">Supporting Documentation</label>
          <br>
            <?php
            $uploadButton = humhub\modules\file\widgets\UploadButton::widget([
            'id' => 'customPostFiles',
            'progress' => '#customPostFiles_progress',
            'preview' => '#customPostFiles_preview',
            'dropZone' => '#ffffil',
            ]); ?>

            <?=humhub\modules\file\widgets\FileHandlerButtonDropdown::widget(['primaryButton' => $uploadButton, 'handlers' => $fileHandlers, 'cssButtonClass' => 'btn-default']);?>

            <?=\humhub\modules\file\widgets\UploadProgress::widget(['id' => 'customPostFiles_progress'])?>

            <?=\humhub\modules\file\widgets\FilePreview::widget(['id' => 'customPostFiles_preview', 'edit' => true, 'options' => ['style' => 'margin-top:10px;']]);?>

            <?=$form->field($model, 'link')->textInput();?>

          <div id="row_arrangement">
            <div id="column_1" class="displayNone">
                <?= $form->field($model, 'connect_challenge')->dropdownList($challenge_list, ['prompt' => 'Connect to challenge']);?>
            </div>
            <div id="colum_2">
                <?=
                $form->field($model, 'connections')->widget(Select2::classname(), [
                'data' => $user_list,
                'options' => ['placeholder' => 'Connect to people', 'multiple' => true],
                'pluginOptions' => [
                  'allowClear' => true,
                ],
                ]); ?>
            </div>
          </div>

          <div class="displayNone product_fields">
            <?= $form->field($model, 'price')->textInput(); ?>
          </div>
            <?=$form->field($model, 'tags')->textInput(['data-role' => 'tagsinput']);?>
        </div>

        <div id="custom_what_in" class="displayNone">
            <?=$form->field($model, 'in_mind')->textArea(['rows' => '3'])?>
        </div>

        <div class="center-btn">
            <?php echo Html::submitButton('SUBMIT', array('id' => 'custom_post_submit', 'class' => '')); ?>
        </div>

        <?php ActiveForm::end();
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-d-close" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">

  $(document).on('click','.popup_btn',function () {
    var value = $(this).attr('data-type');
    $('#custompost-type').val(value);
    changepoup_style(value);
    $('#customPostModal').modal('show');
  });

  function changepoup_style(value) {
    switch(value) {
      case 'challenge':
      $('#modal-dialog_outer').removeClass();
      $('#modal-dialog_outer').addClass('modal-dialog modal-challenge');
      $('#modal_heading').text('Post Challenge');
      $('#modal_descrptn').text('Thank you for contributing to the Earth Ledger Network. Tell us about your challenge below:');
      $('.field-custompost-description').find('label').text('Description');
      $('#row_arrangement').removeClass('row');
      $('#column_1').removeClass('col-sm-6');
      $('#colum_2').removeClass('col-sm-6');
      $('#column_1').hide();
      $('#challenge_field').show();

      $('#top_row_arrangement').removeClass('row');
      $('#top_column_1').removeClass('col-sm-6');
      $('#top_colum_2').removeClass('col-sm-6');
      $('.product_fields').hide();

      $('#custom_what_in').hide();
      $('#all_fields').show();
      break;
      case 'solution':
      $('#modal-dialog_outer').removeClass();
      $('#modal-dialog_outer').addClass('modal-dialog modal-solution');
      $('#modal_heading').text('Post Solution');
      $('#modal_descrptn').text('Thank you for contributing to the Earth Ledger Network. Tell us about your solution below:');
      $('.field-custompost-description').find('label').text('Description');
      $('#column_1').show();
      if (!$('#row_arrangement').hasClass('row')) {
        $('#row_arrangement').addClass('row');
      }
      if (!$('#column_1').hasClass('col-sm-6')) {
        $('#column_1').addClass('col-sm-6');
      }
      if (!$('#colum_2').hasClass('col-sm-6')) {
        $('#colum_2').addClass('col-sm-6');
      }
      $('#top_row_arrangement').removeClass('row');
      $('#top_column_1').removeClass('col-sm-6');
      $('#top_colum_2').removeClass('col-sm-6');
      $('.product_fields').hide();

      $('#custom_what_in').hide();
      $('#all_fields').show();
      $('#challenge_field').hide();
      break;
      case 'product':
      $('#modal-dialog_outer').removeClass();
      $('#modal-dialog_outer').addClass('modal-dialog modal-product');
      $('#modal_heading').text('Post Product');
      $('#modal_descrptn').text('Thank you for contributing to the Earth Ledger Network. Post your product here.');
      $('.field-custompost-description').find('label').text('Description');

      $('.product_fields').show();
      if (!$('#top_row_arrangement').hasClass('row')) {
        $('#top_row_arrangement').addClass('row');
      }
      if (!$('#top_column_1').hasClass('col-sm-6')) {
        $('#top_column_1').addClass('col-sm-6');
      }
      if (!$('#top_colum_2').hasClass('col-sm-6')) {
        $('#top_colum_2').addClass('col-sm-6');
      }

      $('#column_1').show();
      if (!$('#row_arrangement').hasClass('row')) {
        $('#row_arrangement').addClass('row');
      }
      if (!$('#column_1').hasClass('col-sm-6')) {
        $('#column_1').addClass('col-sm-6');
      }
      if (!$('#colum_2').hasClass('col-sm-6')) {
        $('#colum_2').addClass('col-sm-6');
      }
      $('#custom_what_in').hide();
      $('#all_fields').show();
      $('#challenge_field').hide();
      break;
      case 'news':
      $('#modal-dialog_outer').removeClass();
      $('#modal-dialog_outer').addClass('modal-dialog modal-news');
      $('#modal_heading').text('Post News');
      $('#modal_descrptn').text('Thank you for contributing to the Earth Ledger Network. Share your story here.');
      $('#row_arrangement').removeClass('row');
      $('#column_1').removeClass('col-sm-6');
      $('#colum_2').removeClass('col-sm-6');
      $('#column_1').hide();
      $('#top_row_arrangement').removeClass('row');
      $('#top_column_1').removeClass('col-sm-6');
      $('#top_colum_2').removeClass('col-sm-6');
      $('.product_fields').hide();

      $('#custom_what_in').hide();
      $('#all_fields').show();
      $('#challenge_field').hide();
      $('.field-custompost-description').find('label').text('Share your story');
      break;
      case 'custom':
      $('#modal-dialog_outer').removeClass();
      $('#modal-dialog_outer').addClass('modal-dialog modal-custom');
      $('#modal_heading').text('Custom');
      $('#modal_descrptn').text('Thank you for contributing to the Earth Ledger Network.');
      $('#row_arrangement').removeClass('row');
      $('#column_1').removeClass('col-sm-6');
      $('#colum_2').removeClass('col-sm-6');
      $('#column_1').hide();
      $('#top_row_arrangement').removeClass('row');
      $('#top_column_1').removeClass('col-sm-6');
      $('#top_colum_2').removeClass('col-sm-6');
      $('.product_fields').hide();

      $('#all_fields').hide();
      $('#custom_what_in').show();
      $('.field-custompost-description').find('label').text('Share your story');
      break;
    }
  }
  $(document).on('click','#custom_post_submit',function (e) {
    e.preventDefault();
    var site_url = "<?php echo Url::to(['/custom_post/site/save']); ?>";
    $.ajax({
      url: site_url,
      type: 'post',
      cache: false,
      contentType: false,
      processData: false,
      data: new FormData($('#custom_post-sumitForm')[0]),
      success: function (response) {
        if (response.error) {
          $('.help-block').html('');
          $.each(response.message, function (key, val) {
            $('#' + key).parent('div').addClass('has-error');
            $('#' + key).next('.help-block').text(val);
          });
        } else {
          location.reload();
        }
      }
    });
  });
</script>