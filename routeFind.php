<?php 
include 'conn.php';


$current = "Savar";
$destination = "Uttar Badda";


$currentBusIDList = getBusIDList($current,$destination);
echo "We got ".sizeof($currentBusIDList)." buses<br><br>";
$currentBusRouteList = routeIndexCount($currentBusIDList[2]);
// $destinationBusIDList = getBusIDList($destination);
// $destinationBusRouteList = routeIndexCount($destinationBusIDList[0]);

print_r($currentBusRouteList);
echo "<br><br>";
// $arr_of_routeArray = array();
// for ($i=0; $i < count($currentBusIDList); $i++) { 
//     array_push($arr_of_routeArray,routeIndexCount($currentBusIDList[$i]));
// }

// echo count($arr_of_routeArray)."<br><br>";
// print_r($arr_of_routeArray[8]);

// print_r($currentBusList);

// isValueAvailable("Abdullahpur", $arr_of_routeArray);

singleLevelRouteFind($current, $destination, $currentBusRouteList);

// Level 1 Route: single bus route
// Level 2 Route: 2 bus route
// Level 3 Route: 3 bus route
// Level 4 Route: multiple bus route
function singleLevelRouteFind($curnt, $dest, $curntArray){
    include 'conn.php';

    //c: babubazar, d: abdullahpur
    $isFound = FALSE;
    $isCurntFound = in_array($curnt, $curntArray);
    $isDestFound = in_array($dest, $curntArray);
    // echo var_dump($isCurntFound);
    // echo var_dump($isDestFound);
    if ($isCurntFound && $isDestFound) {
        $dst_indx = array_search($dest, $curntArray);
        $curnt_indx = array_search($curnt, $curntArray);

        if ($dst_indx !== false && $curnt_indx !== false) {
            if ($dst_indx >= $curnt_indx) {
                for ($i=$dst_indx; $i >=$curnt_indx ; $i--) { 
                    print($curntArray[$i]);
                    if ($i > $curnt_indx) {echo " => ";}
                }
                echo "<br><br>".$dest." is after ".$curnt." in forward direcion";
            }else {
                for ($i=$curnt_indx; $i >=$dst_indx; $i--) { 
                    print($curntArray[$i]);
                    if ($i > $dst_indx) {echo " => ";}
                }
                echo "<br><br>".$dest." is before ".$curnt." in reverse direcion";
                
            }
            echo "<br>Your Destination is found. <br>You are going to visit $dest from $curnt via <br>";
        }else {
            echo "cur or dest not in single level 1";
        }

        
        // print_r($curntArray);
    }else {
        echo "Didn't found in Level 1.";
    }

    

}


function getBusIDList($curntRouteName, $destRouteName=NULL){
    include 'conn.php';
    $str = "";
    if ($destRouteName === NULL) {
        echo "Hered Enterd";
        $str = "SELECT bus_name_en, bus_route.bus_id FROM bus_list INNER JOIN bus_route ON bus_list.bus_id = bus_route.bus_id WHERE bus_route.route_name LIKE '%$routeName%'";
    }else {
        // $str = "SELECT bus_name_en, bus_route.bus_id FROM bus_list INNER JOIN bus_route ON bus_list.bus_id = bus_route.bus_id WHERE bus_route.route_name LIKE '%$curntRouteName%' or bus_route.route_name LIKE '%$destRouteName%' ";
        // $str = "SELECT bus_route.bus_id, bus_list.bus_name_en, bus_route.route_index, bus_route.route_name 
        // FROM bus_route INNER JOIN bus_list ON bus_list.bus_id = bus_route.bus_id
        // -- WHERE route_name in 
        // WHERE bus_route.bus_id  in 
        $str = "(SELECT bus_route.bus_id FROM bus_route WHERE bus_route.route_name LIKE '%$curntRouteName%') 
        INTERSECT 
        (SELECT bus_route.bus_id FROM bus_route WHERE bus_route.route_name LIKE '%$destRouteName%') ";

        

    }

    

    $res = mysqli_query($con,$str);
    // echo var_dump($res);
    // print_r($res);
    $busList = array();
    while($row = mysqli_fetch_assoc($res)){
        // print($row['bus_name_en']."<br>");
        // print($row['bus_id']."<br><br>");
        array_push($busList, $row['bus_id']);
    }
    return $busList;
}


function isValueAvailable($val, $arrayList){
    
include 'conn.php';
    $c = count($arrayList);
    $isAvail = FALSE;
    for ($i=0; $i < $c; $i++) { 
        $isAvail = in_array($val,$arrayList[$i]);
        if ($isAvail) {
            echo "Here got the value ".$val." in below array. <br>";
            print_r($arrayList[$i]);
            echo "<br><br>";
        }else {
            echo "Not found the value: ".$val."<br>";
        }

    }

}


function routeIndexCount($b_id=0){
    
include 'conn.php';
    $s = "SELECT route_index from bus_route where bus_route.bus_id = $b_id";

    $c = mysqli_query($con, $s);
    $cn = 0;
    while($row = mysqli_fetch_assoc($c)){
        // print($row['route_index']."<br>");
        // print(count($row));
        $cn++;
    }
    // echo $cn."<br><br>";
    if ($cn <=0) {
        echo "This busId has 0 Route";
    }else { 
        // return  array($b_id,$cn);
        return getRouteListNames($b_id,$cn);
    }
}

function getRouteListNames($b_id,$r_count){
    
include 'conn.php';
    $sq = "SELECT route_name from bus_route where bus_route.bus_id = $b_id and bus_route.route_index >0 and  bus_route.route_index <=$r_count ";

    $cr = mysqli_query($con, $sq);
    $routeList = array();
    while($row = mysqli_fetch_assoc($cr)){
        // print($row['route_name']."<br>");
        array_push($routeList, $row['route_name']);
    }
    // print_r($routeList);
    // echo "<br><br><br>";
    return $routeList;
}






















?>