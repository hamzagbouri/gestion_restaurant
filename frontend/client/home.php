<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">

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
                primary: ['Consolas', 'monospace'],
                secondary: ['Pattaya', 'sans-serif'],
                },
            },
            },
        };
        </script>
</head>
<body class="w-full h-full min-h-screen text-white font-primary">
    <header class="bg-[url('../image/image.webp')] bg-cover  bg-no-repeat object-fit h-screen " >
        <nav class="w-full h-24 bg-black bg-opacity-60 flex overflow-hidden items-center justify-around">
            <div class="h-full ">
                <img class="w-32 h-32 pb-8" src="../image/logo2.png" alt="">
            </div>
      
                <ul class="flex w-[30%] justify-around text-lg">
                    <li ><a class="nav-items hover:text-[#9c7e54] hover:font-bold" href="">Home</a></li>
                    <li><a class="nav-items hover:text-[#9c7e54] hover:font-bold "  href="">Menu</a></li>
                    <li><a class="nav-items hover:text-[#9c7e54] hover:font-bold"  href="">Contact</a></li>
                    <?php
                        if(isset($_SESSION['logged_id'])){
                        echo "<li><a href''>My Reservations</a></li>";
                    }
                    ?>
                </ul>
     
            <div>
                <button class="px-4 py-2 bg-primary rounded-xl hover:bg-transparent hover:border-2  hover:text-primary">Login/Signup</button>
            </div>
        </nav>

    </header>
    rr
</body>
</html>