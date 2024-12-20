<?php
session_start();
include '../../backend/database/database.php';
if(isset($_SESSION['id_logged']))
{
    if($_SESSION['role'] == 'user')
    {
        header('Location: /Gestion Restaurant/frontend/client/home.php');
    }
} else {
    header('Location: /Gestion Restaurant/frontend/index.php');
}
$allReservations = $con->query('SELECT * from reservation');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation-Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style >
 
        input[type="search"]::-webkit-search-cancel-button
        {
        -webkit-appearance:none;
        }
        td {
            border-bottom-width: 1px ;
            border-collapse: collapse;
            

        }
       
    </style>
    <script>
        tailwind.config = {
            theme: {
            extend: {
                colors: {
                primary: '#9c7e54',
                borderColor: '#5f5d5d',
                bgcolor: '#F3F3F3',
                },
                fontFamily: {
                // primary: ['Consolas', 'monospace'],
                primary: ['Playfair Display', 'serif'],
                // primary: ['EB Garamond', 'serif'],
                secondary: ['Pattaya', 'sans-serif'],
                },
            },
            },
        };
        </script>
</head>

<body >
<?php
// include('db.php');
// if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
//     $id = $_SESSION['id'];
//     $role = $_SESSION['role'];
//     if($role == "admin"){
//         $result = $con-> query("SELECT * from admin where `id` = $id");
//         $row = $result-> fetch_assoc();
//     } else {
//         $result = $con-> query("SELECT * from `etudiant` where `id` = $id");
//         $row = $result-> fetch_assoc();
//     }
   


// }else {
//     header('Location: /Gestion Restaurant/frontend/index.php');
// }
?>
<div class="flex min-h-screen h-full ">
    <aside class="w-52 border-r min-h-full  flex flex-col items-center gap-16 ">
        <div class="mt-16">
            <img class="w-32" src="../image/logo2.png" alt="logo">
        </div>
        <div class="">
            <div class="grid gap-4 w-[100%]">
                <a href="index.php" class="flex gap-4 px-4 py-2 rounded-2xl"><img src="./img/home.svg" alt=""> Dashboard </a>
                <a href='menu.php' class='flex gap-4 px-4 py-2 rounded-2xl'><img src='./img/briefcase.svg' alt=''> Menu </a>
                <a href='reservation.php' class='flex gap-4 px-4 py-2 rounded-2xl'><img id='btn-icon' class='mt-1' src='./img/3 User.svg' alt=''> Reservations</a>
            </div>
        </div>
    </aside>
    <div class="grow">
        <header class=" h-20 border-b">
            <nav class=" h-full flex justify-between mx-8 items-center">
                <div class="flex gap-2">
                    <img src="./img/Search.svg" alt="">
                    <input class="search outline-none border-none w-64 px-4 py-2 rounded-2xl" type="search" name="search-input" id="search-input" placeholder="Search anything here">
                </div>
                <div class="flex w-72 justify-between  items-center ">
                    <img class="cursor-pointer" src="./img/settings.svg" alt="">
                    <img class="cursor-pointer" src="./img/Icon.svg" alt="">
                    <form action="../../backend/actionsPHP/logout.php" action="post">
                        <button><img src="img/logout.png" class="h-4 w-4" alt=""></button>
                    </form>
                    <div class="flex items-center gap-2 cursor-pointer">
                        <div class=" cursor-pointer w-10 h-10 bg-[url('img/Ana.jpg')] bg-cover rounded-full text-white relative ">
                        <div class="bg-[#228B22] h-3 w-3 rounded-full absolute bottom-0 right-0  "></div>
                        </div>
                       <p class="text-[#606060] font-bold">Hamza GBOURI </p>
                    </div>
                   
                </div>
    
            </nav>
        </header>
       
    <section class="p-4 w-full flex flex-col gap-8">
        <?php
            if (isset($_SESSION['error'])) {
                set_time_limit(2);  
                echo $_SESSION['error'];  
                unset($_SESSION['error']);  
            }
            ?>
            
            <div class="flex justify-between items-center px-8">
                <h1>
                    Reservation
                </h1>
               <div class="flex gap-4">
                    <button class="flex gap-2 items-center border px-4 py-2 rounded-lg text-[#0E2354] ">
                        <img src="./img/Downlaod.svg" alt="">Export
                    </button>
                   
               </div>
            </div>

            <div class="flex justify-between items-center px-4 border py-4 rounded-lg">
                <div class="flex gap-2">
                    <img src="./img/Search.svg" alt="">
                    <input class="search outline-none border-none w-72 px-4 py-2 rounded-2xl" type="search" name="search-input" id="search-input" placeholder="Search reservation by name...">
                </div>
               <div class="flex gap-4 items-center">
                    <button class="flex gap-2 items-center border px-4 py-2 rounded-lg">
                        <img src="./img/Filters lines.svg" alt="">Filters
                    </button>
                    <div class="flex gap-2">
                        <img class="px-4 py-3 border rounded-lg cursor-pointer" src="./img/Vector.svg" alt="">
                        <img class="px-4 py-2 border rounded-lg cursor-pointer" src="./img/element-3.svg" alt="">
                    </div>
               </div>
            </div>
            <div class="flex w-full flex-wrap gap-2 justify-around ">
             
               <?php
               if($allReservations->num_rows>0)
               {
                    foreach($allReservations as $res)
                    {
                        $clientZ = $con->query("SELECT * from user inner join reservation on user.id = reservation.id_client where reservation.id_client= ".$res['id_client']."");
                        $client = $clientZ->fetch_assoc();
                        $menuZ = $con->query("SELECT * from menu inner join reservation on menu.id = reservation.id_menu where reservation.id_menu= ".$res['id_menu']."");
                        $menu = $menuZ->fetch_assoc();
                        ?>
                        <div class="w-[40%] border bg-gray-100 flex flex-col gap-2 rounded-lg p-2">
                        <div class="flex justify-between items-center">
                            <p class="text-center">Reservation Of  <span class="font-bold"><?php echo $client['nom']?></span>  </p>
                            <div class="flex gap-2">
                                <?php if($res['status'] == 'En Attente') {?>
                                    <form action="../../backend/actionsPHP/reservation/updateStatus.php" method="post">
                                        <input type="hidden" name="res-id" value ='<?php echo $res['id']?>'>
                                <button  name="accept" class="bg-[#2c7a0f] rounded-md px-2 py-1">Accept</button>
                                <button name="reject" class="bg-[#ff0000] rounded-md px-2 py-1">Reject</buttona>
                                </form>
                                <?php } else if($res['status'] == 'Accepted') {?>
                               <p class="text-[#2c7a0f]">Accepted</p>
                               <?php } else if($res['status'] == 'Canceled') {?>
                                <p class="text-[#ff0000]">Canceled</p>
                                <?php } else if($res['status'] == 'Rejected') {?>
                                    <p class="text-[#ff0000]">Rejected</p>
                                    <?php } ?>

                            </div>
    
                        </div>
                        <p><span class="text-[#a2a2a2]">Menu: </span><?php echo $menu['titre']?> </p>
                        <p><span class="text-[#a2a2a2]">Nomre de personne: </span><?php echo $res['nbr_personnes']?> </p>
                        <p><span class="text-[#a2a2a2]">Adresse: </span> <?php echo $res['addresse_reservation']?></p>
                        <p><span class="text-[#a2a2a2]">Date: </span> <?php echo $res['date_reservation']?></p>
                        <p><span class="text-[#a2a2a2]">Heure: </span><?php echo $res['heure_reservation']?> </p>
                        <p><span class="text-[#a2a2a2]">Status: </span> <?php echo $res['status']?> </p>
    
                       
                    </div>
                    <?php
                    }
               }else{
                echo "<p> No Reservations Found</p>";
               }
               ?>
             

            </div>
 
          
        </section>

    </div>
   
             
        
</body>
</html>
