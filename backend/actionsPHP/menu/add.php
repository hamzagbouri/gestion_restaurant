<?php
include "../../database/database.php";
session_start();
$allPlatId = array();
$menuid;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $menuTitle = trim(htmlspecialchars($_POST['menu-title']));
    $menuPrice = trim(htmlspecialchars($_POST['menu-price']));
    $nbrPlat = trim(htmlspecialchars($_POST['nbr-plat']));
    $selectedPlats = $_POST['options'] ?? [];   
    try{
    if (empty($selectedPlats) && $nbrPlat == 0) {
       $_SESSION['erro'] = "SELECT AT LEAST A PLAT OR ADD ONE";
    } else {
        if($nbrPlat !== 0)
        {
                for($i = 0;$i<$nbrPlat;$i++)
            {
                $t = $i+1;
              ;
                $platName = trim(htmlspecialchars($_POST["plat-title-$t"]));
                $platCategory = trim(htmlspecialchars($_POST["plat-category-$t"]));
                $platDesc = trim(htmlspecialchars($_POST["plat-description-$t"]));
                $imageName = $_FILES["plat-image-$t"]['name'];
                $imageType = $_FILES["plat-image-$t"]['type'];
                $imageData = file_get_contents($_FILES["plat-image-$t"]['tmp_name']);
             
                
                $stmt2 = $con->prepare("INSERT INTO image (name, type, data) VALUES (?, ?, ?)");
                $stmt2->bind_param("sss", $imageName, $imageType, $imageData);
                $stmt2->execute();
                $imageId = $stmt2->insert_id;
                $stmt3 = $con->prepare("INSERT INTO `plat` (`titre_plat`, `categorie`, `id_image`) VALUES (?, ?, ?)");
                $stmt3->bind_param("sss", $platName, $platCategory, $imageId);
                $stmt3->execute();
                $allPlatId[] = $stmt3->insert_id;
                
            
            }
        }
        if(!empty($selectedPlats))
        {
            foreach($selectedPlats as $ro){
                $allPlatId[] = $ro;
            }
        }
    }




    $stmt = $con->prepare('INSERT INTO `menu` (`titre`, `prix`) VALUES (?, ?)');
    var_dump($menuTitle);
    var_dump($menuPrice);
    $stmt-> bind_param('ss',$menuTitle, $menuPrice);
    
    $stmt->execute();
    $menuid = $stmt->insert_id;
    $stmt->close();
    foreach($allPlatId as $platId){
        $stmt5 = $con-> prepare('INSERT INTO `menu_plat`  (`id_menu` ,`id_plat` )  VALUES (?,?) ');
        $stmt5-> bind_param('ss',$menuid,$platId,);
        $stmt5->execute();
    }
    header('Location: /Gestion Restaurant/frontend/admin/menu.php');

}catch (Exception $e){
    die("coiuldn't add");
}

}
?>