<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro timer</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bluee: '#0093E9',
                        titletext: '#002765',
                        rowbackground: '#edeef0',
                        btnbackground: '#ff5945'
                    }
                }
            }
        }
    </script>
</head>
<body>


<nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">

    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-2.5">
        <a href="?mod=product" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="../../public/images/cart.jpg" class="h-8" alt="Cart Logo"/>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Shoppu</span>
        </a>
        <?php
        if (isset($_SESSION['user_id'])): ?>
        <button data-collapse-toggle="navbar-dropdown" type="button"
                class="inline-flex items-center p-2 ms-3 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul class="flex flex-col font-medium p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:mt-0 md:text-sm  md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 md:space-x-8 md:rtl:space-x-reverse">
                <li>
                    <a href="#"
                       class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-white dark:bg-blue-600 md:dark:bg-transparent"
                       aria-current="page">Home</a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between w-full py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                        Dropdown
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar"
                         class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="#"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#"
                       class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                </li>
                <li>
                    <a href="#"
                       class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
                </li>
                <li>
                    <a href="#"
                       class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
                </li>
            </ul>
        </div>

        <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                type="button">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 me-2 rounded-full"
                 src="https://ui-avatars.com/api/?name=<?= ($_SESSION['username'] ?? ""); ?>"
                 alt="user photo">
            <?= ($_SESSION['username'] ?? ""); ?>
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4"/>
            </svg>
        </button>


        <!-- Dropdown menu -->
        <div id="dropdownAvatarName"
             class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                <div class="font-medium ">Pro User</div>
                <div class="truncate">name@flowbite.com</div>
            </div>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                <li>
                    <a href="#"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                    <a href="#"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                </li>
                <li>
                    <a href="#"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                </li>
            </ul>
            <div class="py-2">
                <a href="?mod=auth&act=logout"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                    out</a>
            </div>
        </div>

    </div>
    <?php
    endif; ?>
</nav>


