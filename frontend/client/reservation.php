<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
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
    <?php include 'header.php'; ?>
    <section class="bg-bgcolor py-16 px-8">
    <div class="container mx-auto">
        <h2 class="text-[40px] text-center text-black font-bold mb-12">
            Your <span class="text-primary">Reservations</span>
        </h2>

        <!-- Reservation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            <!-- Reservation 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-primary mb-4">Reservation 1</h3>
                <ul class="text-gray-700">
                    <li><span class="font-bold">Adresse:</span> 123 Luxury Street, Casablanca</li>
                    <li><span class="font-bold">Nombre de Personnes:</span> 4</li>
                    <li><span class="font-bold">Date:</span> 2024-12-25</li>
                    <li><span class="font-bold">Heure:</span> 19:00</li>
                </ul>
                <button class="mt-6 bg-primary text-white py-2 px-4 rounded hover:bg-[#826642] transition duration-300">
                    Edit Reservation
                </button>
            </div>

            <!-- Reservation 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-primary mb-4">Reservation 2</h3>
                <ul class="text-gray-700">
                    <li><span class="font-bold">Menu:</span> Menu 1</li>  
                    <li><span class="font-bold">Adresse:</span> 456 Elegant Avenue, Marrakech</li>
                    <li><span class="font-bold">Nombre de Personnes:</span> 2</li>
                    <li><span class="font-bold">Date:</span> 2024-12-26</li>
                    <li><span class="font-bold">Heure:</span> 20:30</li>
                </ul>
                <button class="mt-6 bg-primary text-white py-2 px-4 rounded hover:bg-[#826642] transition duration-300">
                    Edit Reservation
                </button>
            </div>

            <!-- Add more static reservations as needed -->
        </div>

        <!-- Add Reservation Button -->
        <div class="text-center mt-16">
            <button 
                onclick="toggleModal()" 
                class="bg-primary text-white py-3 px-6 rounded-lg text-lg hover:bg-[#826642] transition duration-300">
                Make a New Reservation
            </button>
        </div>
    </div>

    <!-- Reservation Modal -->
    <div id="reservationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 shadow-lg w-[90%] md:w-[50%]">
            <h3 class="text-2xl font-bold text-primary mb-6">New Reservation</h3>
            <form>
            <div class="mb-4">
                    <label class="block font-bold text-gray-700 mb-2">Menu</label>
                    <select name="menu-select" id="menu-select" class="w-full border border-gray-300 text-gray-600 rounded-md p-2 focus:ring-primary focus:border-primary">
                        <option value="" checked >Chooose a menu</option>
                        <option value="menu1">menu1</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block font-bold text-gray-700 mb-2">Adresse</label>
                    <input 
                        type="text" 
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-primary focus:border-primary"
                        placeholder="Enter Address"
                    >
                </div>
                <div class="mb-4">
                    <label class="block font-bold text-gray-700 mb-2">Nombre de Personnes</label>
                    <input 
                        type="number" 
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-primary focus:border-primary"
                        placeholder="Enter Number of People"
                    >
                </div>
                <div class="mb-4">
                    <label class="block font-bold text-gray-700 mb-2">Date</label>
                    <input 
                        type="date" 
                        class="w-full border border-gray-300 rounded-md p-2 text-gray-600 focus:ring-primary focus:border-primary"
                    >
                </div>
                <div class="mb-4">
                    <label class="block font-bold text-gray-700 mb-2">Heure</label>
                    <input 
                        type="time" 
                        class="w-full border border-gray-300 rounded-md text-gray-600 p-2 focus:ring-primary focus:border-primary"
                    >
                </div>
                <div class="flex justify-end space-x-4">
                    <button 
                        type="button" 
                        onclick="toggleModal()" 
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-300">
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="bg-primary text-white py-2 px-4 rounded hover:bg-[#826642] transition duration-300">
                        Confirm Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function toggleModal() {
        const modal = document.getElementById('reservationModal');
        modal.classList.toggle('hidden');
    }
</script>


    <?php include 'footer.php';?>
    
</body>
</html>