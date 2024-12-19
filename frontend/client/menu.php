<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />



    <style >
       
        input[type="search"]::-webkit-search-cancel-button
        {
        -webkit-appearance:none;
        }
        .nav-items {
        position: relative;
    }
        .nav-items::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #9c7e54;
            transition: width 0.3s ease;
        }

        .nav-items:hover::after {
            width: 100%;
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
<body class="w-full h-full min-h-screen text-white font-primary ">
    <?php include 'header.php';
        $allMenu = $con ->query('SELECT * from menu');

    ?>
    <section class="flex flex-col w-full h-full p-32 items-center justify-center text-black">
        <h1 class="text-[50px] ">Our <span class='text-primary font-bold'>Menu</span></h1>
     <div class="flex gap-2">
        <p class='border px-4 py-2 cursor-pointer'>1</p>
        <p class='border px-4 py-2 cursor-pointer'>2</p>
        <p class='border px-4 py-2 cursor-pointer'>3</p>
     </div>
        <div class="flex h-[100%] gap-8 pt-8">
            <div class="flex flex-col gap-4 justufy-around h-auto h-[100%] w-[50%]">
            <?php
                    $cmp = 0;
                    foreach($allMenu as $menu){
                        echo "<div class='p-2 flex flex-col gap-2 border-t-2 border-b-2 w-full hover:border-primary hover:border-t-4 hover:border-b-4'>
                        <div class='flex justify-between'>
                        <p>" .$menu['titre'] ."</p>
                        <p class='text-primary text-xl '>" .$menu['prix'] ."$</p>
                        </div>
                        ";
                        $allPlat = $con->query("SELECT * from plat inner join menu_plat on menu_plat.id_plat = plat.id inner join menu on menu_plat.id_menu = menu.id where menu.id = ".$menu['id']."");
                        $plats = [];
                        foreach ($allPlat as $plat) {
                            $plats[] = $plat['titre_plat']; // Collect the plat names in an array
                        }
                    
                        echo "<p>" . implode(", ", $plats) . "</p>"; // Join plat names with a comma and space
                    
                        echo "</div>";
                    
                        $cmp++;
                        if ($cmp == 6) {
                            break;
                        }
                    }
                    ?>
                    
                    
                    
                    
            
                    
            </div>
            <div class=" flex flex-wrap w-[60%] gap-4">
                    <img class="w-[50%] h-64 rounded-t-full rounded-bl-full" src="../image/plat.jpg" alt="">
                    <img class="w-[40%] h-64 rounded-t-full rounded-br-full" src="../image/plat.jpg" alt="">
                    <img class="w-[50%] h-64 rounded-b-full rounded-tl-full" src="../image/plat.jpg" alt="">
                    <img  class="w-[40%] h-64 rounded-b-full rounded-tr-full"src="../image/plat.jpg" alt="">
            </div>

        </div>
        
    </section>

    <?php include 'footer.php'  ;?>
    <script>
        function openBookModal(){
            <?php
                if(!isset($_SESSION['id_logged']))
                {
                    header ('Location: Gestion Restaurant/frontend/index.php');
                }
                ?>
                console.log('aa')
        }
    </script>
    
</body>
</html>