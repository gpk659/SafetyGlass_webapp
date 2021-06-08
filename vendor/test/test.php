<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 * Date: 12-09-18
 * Time: 23:32

 $("#linktest").click(function(event){

       $.ajax({
         url: './testsql.php',
         data: { 'abv' : abreviation, 'descr' : description, 'lg': largeur, 'ht' :longueur },
         type: 'POST',
         dataType: 'json',
         success : function(data, status, code){
              console.log('data : '+JSON.stringify(data)+'\n'+'status : '+status+'\n'+'code : '+JSON.stringify(code));
           },
         error : function(code,status,error){
                console.log('code : '+code+'\n'+'status : '+status+'\n'+'error : '+error);
          }
       });
 });
 */

echo 76 <=> '76 trombones';
$urgent="";
$jPlusUn="";
$jPlusDeux="";
$jPlusTrois="";
$jPlusPlus="";

$dateppp = date('Y-m-d',strtotime(date('Y-m-d') . "+3 days"));

function etatVolume($date){
  global $urgent, $jPlusUn, $jPlusDeux,$jPlusTrois,$jPlusPlus, $dateppp;

  if($date == date('Y-m-d')){
  /*echo "Urgent JO";*/
    $urgent++;
  }else if ($date < date('Y-m-d')) {
    $urgent++;
  }else if($date == date('Y-m-d',strtotime(date('Y-m-d') . "+1 days"))){
    //echo "J+1";
    $jPlusUn++;
  }else if($date == date('Y-m-d',strtotime(date('Y-m-d') . "+2 days"))){
    //echo "J+2";
    $jPlusDeux++;
  }else if($date == date('Y-m-d',strtotime(date('Y-m-d') . "+3 days"))){
    //echo "J+3";
    $jPlusTrois++;
  }else if($date >= $dateppp){
    //echo "J>3";
    $jPlusPlus++;
  }else{
    echo "erreur<br />";
  }
}

etatVolume('2019-03-11');
etatVolume('2018-04-13');
etatVolume('2018-06-15');
etatVolume('2018-07-02');
etatVolume('2019-03-27');
etatVolume('2019-03-28');
etatVolume('2019-03-26');
etatVolume('2019-06-20');

?>
<style>
.stylestatus{
  border-bottom: 1px solid #ddd;
  border-left: 1px solid #ddd;
  border-top: 1px solid #ddd;
}

</style>
<table class="statustable">
  <tbody>
    <tr>
      <td></td>
      <td class="stylestatus">Urgent</td>
      <td class="stylestatus">J+1</td>
      <td class="stylestatus">J+2</td>
      <td class="stylestatus">J+3</td>
      <td class="stylestatus">J>3</td>
    </tr><tr>
      <td>Nb </td>
      <td class="stylestatus danger"><?php echo $urgent; ?></td>
      <td class="stylestatus"><?php echo $jPlusUn; ?></td>
      <td class="stylestatus"><?php echo $jPlusDeux; ?></td>
      <td class="stylestatus"><?php echo $jPlusTrois; ?></td>
      <td class="stylestatus"><?php echo $jPlusPlus; ?></td>
    </tr>
  </tbody>
</table>

<?php
echo date('Y-m-d');
