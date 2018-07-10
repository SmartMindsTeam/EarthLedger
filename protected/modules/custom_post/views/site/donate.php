  <h3>DONATE TO THE EARTH LEDGER FOUNDATION</h3>
  <ul>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/BTC.png';?>">
      <button id="donate_btc" class="btn load-donate_popup">BTC</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/EOS.png';?>">
      <button id="donate_eos" class="btn load-donate_popup">EOS</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/BCH.png';?>">
      <button id="donate_bch" class="btn load-donate_popup">BCH</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/ICX.png';?>">
      <button id="donate_icx" class="btn load-donate_popup">ICX</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/BAT.png';?>">
      <button id="donate_bat" class="btn load-donate_popup">BAT</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/ETH.png';?>">
      <button id="donate_eth" class="btn load-donate_popup">ETH</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/LTC.png';?>">
      <button id="donate_ltc" class="btn load-donate_popup">LTC</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/VEN.png';?>">
      <button id="donate_ven" class="btn load-donate_popup">VEN</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/ZRX.png';?>">
      <button id="donate_zrx" class="btn load-donate_popup">ZRX</button>
    </li>
    <li>
      <img src="<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/POWR.png';?>">
      <button id="donate_powr" class="btn load-donate_popup">POWR</button>
    </li>
  </ul>
  <p>We accept 10 different cryptocurrencies. Please click on your preferred asset to copy the address or scan the QR code.</p>

<div id="donateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal">CLOSE</button>

            <div id="img-holder"></div>
            <div class="box">
            <p id="donate-pop_head"></p>
            <p id="donate-pop_data"></p>
            </div>

      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
  $(document).on('click','.load-donate_popup',function () {
    var data_id = $(this).attr('id');
    var img = "<?=Yii::$app->getModule('custom_post')->getAssetsUrl() . '/img/';?>"+data_id+".png";
    switch(data_id){
      case 'donate_btc':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('BTC Deposit Address');
        $('#donate-pop_data').html('3H7kL2z3DeXXNioJXNQ6eZniZY6eTxLotn');
      break;

      case 'donate_eos':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('EOS Deposit Address');
        $('#donate-pop_data').html('0x0E7a94f1f17d46dd2c237605130580BD1395B8bF');
      break;

      case 'donate_bch':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('BCH Deposit Address');
        $('#donate-pop_data').html('qraveuftmlp40ex9w3jqngauq9rx8g2xdqcpja0p8s');
      break;

      case 'donate_icx':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('ICX Deposit Address');
        $('#donate-pop_data').html('0x0E7a94f1f17d46dd2c237605130580BD1395B8bF');
      break;

      case 'donate_bat':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('BAT Deposit Address');
        $('#donate-pop_data').html('0x0E7a94f1f17d46dd2c237605130580BD1395B8bF');
      break;

      case 'donate_eth':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('ETH Deposit Address');
        $('#donate-pop_data').html('0x0E7a94f1f17d46dd2c237605130580BD1395B8bF');
      break;

      case 'donate_ltc':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('LTC Deposit Address');
        $('#donate-pop_data').html('LVLP7X4WHmXECu9NBqApuBjNvX4Ybr5z95');
      break;

      case 'donate_ven':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('VEN Deposit Address');
        $('#donate-pop_data').html('0x0E7a94f1f17d46dd2c237605130580BD1395B8bF');
      break;

      case 'donate_zrx':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('ZRX Deposit Address');
        $('#donate-pop_data').html('0x0E7a94f1f17d46dd2c237605130580BD1395B8bF');
      break;

      case 'donate_powr':
        $('#img-holder').html('<img src="'+img+'">');
        $('#donateModal').modal('show');
        $('#donate-pop_head').html('POWR Deposit Address');
        $('#donate-pop_data').html('0x0E7a94f1f17d46dd2c237605130580BD1395B8bF');
      break;


      case '':
      break;
    }
  })
</script>