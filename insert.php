<?php 
include 'scrp.php';
$html = file_get_html("local.php");
$GLOBALS['html'];


class RouteHandle{
    private $route;
    private $delimeter;
    function __construct($route,$delimeter){
        $this->route = $route;
        $this->delimeter = $delimeter;
    }
    public function getRoute(){
        
        $r = $this->replaceAllMinus($this->route);
        return explode($this->delimeter,$r);
    }
    private function replaceAllMinus($str){
        $c = substr_count($str," – ");
        // echo $c." found "."<br>";
        if ($c >= 1) {
            return str_replace(" – ", " ⇄ ", $str);
        }else {
            return $str;
        }

    }
    

}




class DbConnect{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $con;
    function __construct($host, $u, $p, $d){
        $this->host = $host;
        $this->user = $u;
        $this->pass = $p;
        $this->db = $d;

        $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        $char_query = "SET characte_set_result = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database='utf8',  character_set_server = 'utf8'  ";
        mysqli_query($this->con, $char_query);
        mysqli_set_charset($this->con, 'utf8');// This line help me to insert data in bangla danguage at mysql database

        echo !$this->con?"Problem in Connection <br>":"";

    }
    function db_bus_list_insert($b_id, $b_name_en, $b_name_bn){
        $q = "INSERT INTO bus_list(bus_id, bus_name_en, bus_name_bn) VALUE ( $b_id,'$b_name_en', '$b_name_bn' )";
        $res = $this->con->query($q);
        if ($res) {
            echo "Bus List: Data Inserted Successfully.<br>";
            return TRUE;
        }else {
            echo "Bus List: Data Insertion Didn't Successfully.<br>";
            return FALSE;
        }
    }
    function db_bus_id_get($b_name){
        $s = "SELECT bus_id FROM bus_list WHERE bus_name_en = '$b_name' ";
        $a = $this->con->query($s);
        $id = mysqli_fetch_assoc($a);
        // mysqli_fetch_assoc($a,);
        return $id['bus_id'];
    }

    function db_bus_route_insert($b_id,$route_array){

        for($i = 0; $i <= count($route_array); $i++){
            if ($i>=count($route_array)) {
                break;
            }
            $s = "INSERT INTO bus_route(bus_id, route_index, route_name) VALUE ($b_id,$i+1,'$route_array[$i]')";
            $this->con->query($s);

        }
    }
}

class AutomationDataScrapping{


    function remText($str, $rmText, $b){
        $r = str_replace($rmText,"",$str);
        return str_replace($b,"",$r);

    }
    function nameSize($s,$p){
        if ($p == "en") {

            $r = explode("Bus Route",$s);
            $a = str_replace("(","",$r[1]);
            $b = str_replace(")","",$a);
            $r[1] = $b;
            return $r;
            
        }elseif ($p == "bn") {
            if (substr_count($s, "বাস") >=1) {
                return str_replace("বাস", "", $s);
            }else {
                return $s;
            }
        }


        

    }




}


$obj = new DbConnect("localhost","root","","bus");



// $BUS_ID=201;
// $BUS_NAME_EN="Borak";
// $BUS_NAME_BN="বোরাক";
// $BUS_ROUTE = "Palashi ⇄ Meghna Ghat";



// $ar = $rout_obj->getRoute();




// $isBusInserted = $obj->db_bus_list_insert($BUS_ID,trim($BUS_NAME_EN),trim($BUS_NAME_BN) );

// if ($isBusInserted) {
//     $busID = $obj->db_bus_id_get($BUS_NAME_EN);
//     $obj->db_bus_route_insert($busID,$ar);
//     echo $BUS_NAME_EN." - ".$BUS_ID." : inserted Succeccfully. <br>";
// }else {
//     echo $BUS_NAME_EN." - ".$BUS_ID." : data not inserted. <br>";
// }

$BUS_ID=100;
$autoDataScrpRes = new AutomationDataScrapping();
//  $title = $html->find('h6',0)->find('span',0)->firstChild();
//  $title = $html->find('h6', 1)->innerText();

    // $title = $html->find('h6',0)->innerText();
    // echo $title;
    // echo var_dump($title);
// for ($i=0; $i < 174; $i++) { 
    // $a="Gabtoli ⇄ Technical ⇄ Ansar Camp ⇄ Mirpur 1 ⇄ Sony Cinema Hall ⇄ Mirpur 2 ⇄ Mirpur 10 ⇄ Mirpur 11 ⇄ Purobi ⇄ Kalshi ⇄ ECB Square ⇄ MES ⇄ Shewra ⇄ Kuril Bishwa Road ⇄ Jamuna Future Park ⇄ Bashundhara ⇄ Nadda ⇄ Notun Bazar ⇄ Bashtola ⇄ Shahjadpur ⇄ Uttar Badda ⇄ Badda – Madhya Badda ⇄ Merul ⇄ Rampura Bridge ⇄ Banasree ⇄ Demra Staff Quarter";
    // echo var_dump($a);
    // $rout_spn1 = $html->find('tr',0)->find('td',1)->find('strong',0);//route strong tag
    //     $rt = $html->find('tr',0)->find('td',1)->innerText();//route text
        
    //     echo $rout_spn1;
    //     echo var_dump($rt);                  
for ($i=0; $i < 174; $i++) { 

    $title = $html->find('h6',$i)->innerText();//bus title
    $spn1 = $html->find('h6',$i)->find('span',0);//br tag
    $spn2 = $html->find('h6',$i)->find('span',1);//br tag
    $title = $autoDataScrpRes->remText($title,$spn1,$spn2);
    // echo $title;

    $rt = $html->find('tr',$i)->find('td',1)->innerText();//route text
    $rout_spn1 = $html->find('tr',$i)->find('td',1)->find('strong',0)->innerText();//route strong tag
    $see_full_route = $html->find('tr',$i)->find('strong',0);//see you tag
    $br = $html->find('tr',$i)->find('br',0);//br tag

    $NameArray = $autoDataScrpRes->nameSize($title,"en");
    $BUS_ID++;
    $BUS_NAME_EN=$NameArray[0];
    $BUS_NAME_BN=$autoDataScrpRes->nameSize($NameArray[1],"bn");
    $bus_rout_data = $autoDataScrpRes->remText($rt,$see_full_route,$br);
    $BUS_ROUTE = $autoDataScrpRes->remText($bus_rout_data,$rout_spn1,"");
    
    $rout_obj = new RouteHandle($BUS_ROUTE," ⇄ ");
    $ar = $rout_obj->getRoute();
    //     $busID = $obj->db_bus_id_get($BUS_NAME_EN);

    // echo $busID;
    
    // echo var_dump($BUS_ID); echo '<br>'; 
    // echo var_dump($BUS_NAME_EN); echo '   ';
    // echo var_dump($BUS_NAME_BN); echo '<br>';
    // echo var_dump($BUS_ROUTE); echo '<br><br><br>';

    // $isBusInserted = $obj->db_bus_list_insert($BUS_ID,trim($BUS_NAME_EN),trim($BUS_NAME_BN) );

    // if ($isBusInserted) {
    //     $busID = $obj->db_bus_id_get($BUS_NAME_EN);
    //     $obj->db_bus_route_insert($busID,$ar);
    //     echo $BUS_NAME_EN." - ".$BUS_ID." : inserted Succeccfully. <br>";
    // }else {
    //     echo $BUS_NAME_EN." - ".$BUS_ID." : data not inserted. <br>";
    // }




}






















?>






























































